--CREATE DATABASE OPELFONE
--drop DATABASE OPELFONE
--GO 
--USE OPELFONE

GO
CREATE TABLE Cliente (
    ID_cliente INT NOT NULL,
    Nombre VARCHAR(80) NOT NULL,
    Apellidos VARCHAR(80) NOT NULL,
    Edad INT NOT NULL,
    Fecha_Nacimiento DATE NOT NULL,
    Domicilio VARCHAR(200) NOT NULL,
    Email_C VARCHAR(120) NOT NULL,
    Contraseña_cliente VARCHAR(255) NOT NULL,
    Fecha_registro DATETIME NOT NULL,
    Estado VARCHAR(10) NOT NULL,
    CONSTRAINT PK_Cliente PRIMARY KEY (ID_cliente)
);
GO
CREATE TABLE Administrador (
    ID_admin INT NOT NULL,
    Nombre VARCHAR(80) NOT NULL,
    Email_Admin VARCHAR(120) NOT NULL,
    Contraseña_admin VARCHAR(255) NOT NULL,
    CONSTRAINT PK_Administrador PRIMARY KEY (ID_admin)
);
GO
CREATE TABLE Telefono (
    ID_Telefono INT NOT NULL,
    Numero VARCHAR(15) NOT NULL,
    Saldo MONEY NOT NULL,
    Estado_activo BIT DEFAULT 0,
    Desvio_activo BIT DEFAULT 0,
    CONSTRAINT PK_Telefono PRIMARY KEY (ID_Telefono)
);
GO
CREATE TABLE Mensaje (
    Id_mensaje INT NOT NULL,
    Contenido VARCHAR(MAX) NOT NULL,
    Fecha_envio DATE NOT NULL,
    Costo MONEY NOT NULL,
    Tipo VARCHAR(15) NOT NULL,
    CONSTRAINT PK_Mensaje PRIMARY KEY (Id_mensaje)
);
GO
CREATE TABLE Tarifa (
    ID_tarifa INT NOT NULL,
    Tipo_horario VARCHAR(10) NOT NULL,
    Comision_fija MONEY NOT NULL,
    Porcentaje MONEY NOT NULL,
    Hora_inicio TIME NOT NULL,
    Hora_fin TIME NOT NULL,
    Activa BIT DEFAULT 1,
    CONSTRAINT PK_Tarifa PRIMARY KEY (ID_tarifa)
);
GO
CREATE TABLE Horario (
    ID_horario INT NOT NULL,
    Hora_actual TIME NOT NULL,
    Fecha DATE NOT NULL,
    CONSTRAINT PK_Horario PRIMARY KEY (ID_horario)
);

GO


 ---Tabla METODO_PAGO (Depende de Cliente/Usuario)
CREATE TABLE Metodo_pago (
    ID_metodo INT  NOT NULL,
    Tipo_pago VARCHAR(20) NOT NULL,
    Datos_bancarios VARCHAR(255) NOT NULL, 
    ID_usuario INT NOT NULL,
    CONSTRAINT PK_Metodo_pago PRIMARY KEY (ID_metodo),
    CONSTRAINT CHK_TipoPago CHECK (Tipo_pago IN ('TARJETA_CREDITO', 'TARJETA_DEBITO', 'EFECTIVO', 'PAYPAL')), -- Puedes ajustar o expandir los estados aquí
    CONSTRAINT FK_MetodoPago_Cliente FOREIGN KEY (ID_usuario) REFERENCES Cliente(ID_cliente)
);
GO
 ----Tabla RECARGA (Depende de Telefono y Metodo_pago)
CREATE TABLE Recarga (
    Id_recarga INT IDENTITY(1,1) NOT NULL,
    Monto DECIMAL(8,2) NOT NULL,
    Fecha DATETIME NOT NULL,
    Hora TIME NOT NULL,
    Tipo_horario VARCHAR(10) NOT NULL,
    Comision DECIMAL(6,2) NOT NULL,
    Total_cobrado DECIMAL(8,2) NOT NULL,
    Estado VARCHAR(10) NOT NULL,
    Id_telefono INT NOT NULL,
    Id_metodo INT NOT NULL,
    CONSTRAINT PK_Recarga PRIMARY KEY (Id_recarga),
    CONSTRAINT CHK_Recarga_Monto CHECK (Monto >= 10.00 AND Monto <= 1000.00),
    CONSTRAINT CHK_Recarga_Horario CHECK (Tipo_horario IN ('DIURNO', 'NOCTURNO', 'MIXTO')),
    CONSTRAINT CHK_Recarga_Estado CHECK (Estado IN ('PENDIENTE', 'APROBADA', 'RECHAZADA')),
    CONSTRAINT FK_Recarga_Telefono FOREIGN KEY (Id_telefono) REFERENCES Telefono(ID_Telefono),
    CONSTRAINT FK_Recarga_Metodo FOREIGN KEY (Id_metodo) REFERENCES Metodo_pago(ID_metodo)
);
GO
 ---Tabla PAGO (Depende de Metodo_pago)
CREATE TABLE Pago (
    Id_pago INT  NOT NULL,
    Monto MONEY NOT NULL,
    Metodo VARCHAR(30) NOT NULL,
    Fecha_pago DATETIME NOT NULL,
    Estado VARCHAR(10) NOT NULL,
    Id_metodo INT NOT NULL,
    CONSTRAINT PK_Pago PRIMARY KEY (Id_pago),
    CONSTRAINT CHK_Pago_Estado CHECK (Estado IN ('PENDIENTE', 'APROBADO', 'RECHAZADA')),
    CONSTRAINT FK_Pago_Metodo FOREIGN KEY (Id_metodo) REFERENCES Metodo_pago(ID_metodo)
);
GO
--- Tabla FACTURA (Depende de Cliente/Usuario y Pago)
CREATE TABLE Factura (
    Id_factura INT NOT NULL,
    Folio VARCHAR(30) NOT NULL,
    Fecha_Factura DATETIME NOT NULL,
    Total DECIMAL(10,2) NOT NULL,
    Estado VARCHAR(10) NOT NULL,
    Id_usuario INT NOT NULL,
    Id_pago INT NOT NULL,
    CONSTRAINT PK_Factura PRIMARY KEY (Id_factura),
    CONSTRAINT UQ_Factura_Folio UNIQUE (Folio),
    CONSTRAINT CHK_Factura_Estado CHECK (Estado IN ('GENERADA', 'PAGADA', 'CANCELADA')),
    CONSTRAINT FK_Factura_Cliente FOREIGN KEY (Id_usuario) REFERENCES Cliente(ID_cliente),
    CONSTRAINT FK_Factura_Pago FOREIGN KEY (Id_pago) REFERENCES Pago(Id_pago)
);

GO
 ---HISTORIAL Y NOTIFICACIONES

CREATE TABLE Historial_actividad (
    Id_historial INT  NOT NULL,
    Evento VARCHAR(80) NOT NULL, -- 'LOGIN', 'MENSAJE_ENVIADO'
    Tipo VARCHAR(40) NOT NULL,
    Descripcion VARCHAR(MAX) NULL,
    Fecha DATETIME NOT NULL,
    Id_usuario INT NOT NULL,
    CONSTRAINT PK_Historial_actividad PRIMARY KEY (Id_historial),
    CONSTRAINT FK_Historial_Cliente FOREIGN KEY (Id_usuario) REFERENCES Cliente(ID_cliente)
);
GO
CREATE TABLE Notificacion (
    Id_notificacion INT  NOT NULL,
    Contenido VARCHAR(MAX) NOT NULL,
    Tipo VARCHAR(40) NOT NULL, -- 'SALDO', 'ERROR', etc.
    Fecha DATETIME NOT NULL,
    Leida BIT NOT NULL DEFAULT 0,
    Id_usuario INT NOT NULL,
    CONSTRAINT PK_Notificacion PRIMARY KEY (Id_notificacion),
    CONSTRAINT FK_Notificacion_Cliente FOREIGN KEY (Id_usuario) REFERENCES Cliente(ID_cliente)
);
GO

 ---GESTIÓN ADMINISTRATIVA

CREATE TABLE Gestion_usuarios (
    Id_gestion INT NOT NULL,
    Accion VARCHAR(30) NOT NULL, -- 'ALTA', 'BAJA', 'ACTUALIZACION'
    Fecha DATETIME NOT NULL,
    Detalle VARCHAR(MAX) NULL,
    Id_admin INT NOT NULL,
    Id_usuario INT NOT NULL, 
    CONSTRAINT PK_Gestion_usuarios PRIMARY KEY (Id_gestion),
    CONSTRAINT FK_GestionU_Admin FOREIGN KEY (Id_admin) REFERENCES Administrador(ID_admin),
    CONSTRAINT FK_GestionU_Cliente FOREIGN KEY (Id_usuario) REFERENCES Cliente(ID_cliente)
);
GO
CREATE TABLE Monitoreo (
    Id_monitoreo INT NOT NULL,
    Fecha DATETIME NOT NULL,
    Estado_sistema VARCHAR(20) NOT NULL, -- 'ESTABLE', 'DEGRADADO', etc.
    Observaciones VARCHAR(MAX) NULL,
    Id_admin INT NOT NULL,
    CONSTRAINT PK_Monitoreo PRIMARY KEY (Id_monitoreo),
    CONSTRAINT FK_Monitoreo_Admin FOREIGN KEY (Id_admin) REFERENCES Administrador(ID_admin)
);
GO
CREATE TABLE Estadistica (
    Id_estadistica INT NOT NULL,
    Fecha DATETIME NOT NULL,
    Detalle VARCHAR(MAX) NULL,
    Total_usuarios INT NOT NULL, 
    Mensajes_enviados INT NOT NULL,
    Recargas_realizadas INT NOT NULL,
    Id_admin INT NOT NULL,
    CONSTRAINT PK_Estadistica PRIMARY KEY (Id_estadistica),
    CONSTRAINT FK_Estadistica_Admin FOREIGN KEY (Id_admin) REFERENCES Administrador(ID_admin)
);
GO
CREATE TABLE Gestion_facturacion (
    Id_gestion INT NOT NULL,
    Accion VARCHAR(30) NOT NULL, -- 'GENERAR', 'CANCELAR'
    Fecha DATETIME NOT NULL,
    Detalle VARCHAR(MAX) NULL,
    Id_admin INT NOT NULL,
    CONSTRAINT PK_Gestion_facturacion PRIMARY KEY (Id_gestion),
    CONSTRAINT FK_GestionF_Admin FOREIGN KEY (Id_admin) REFERENCES Administrador(ID_admin)
);