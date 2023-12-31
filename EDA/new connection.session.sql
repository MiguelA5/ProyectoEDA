

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correoUsuario VARCHAR(255),
    Contrasena VARCHAR(255),
    Fecha_Nacimiento DATE,
    Sexo VARCHAR(10),
    Foto VARCHAR(255)
);


-- Tabla de Estilos de Aprendizaje
CREATE TABLE EstilosAprendizaje (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NombreEstilo VARCHAR(50) NOT NULL,
    Descripcion TEXT
);

-- Tabla de Actividades
CREATE TABLE Actividades (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NombreActividad VARCHAR(255) NOT NULL,
    Descripcion TEXT,
    EstiloAprendizajeID INT,
    ProfesorID INT,
    FechaCreacion DATE
    -- Otros campos relacionados con recursos de actividad (por ejemplo, archivos adjuntos, enlaces)
);

-- Tabla de Profesores
CREATE TABLE Profesores (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NombreProfesor VARCHAR(255) NOT NULL,
    CorreoProfesor VARCHAR(255) NOT NULL,
    ContrasenaProfesor VARCHAR(255) NOT NULL,
    -- Otra información del profesor
    Especializacion TEXT,
    Experiencia TEXT,
    Logros TEXT,
    FechaRegistro DATE
);

-- Tabla de Registros de Actividades
CREATE TABLE RegistrosActividades (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    UsuarioID INT,
    ActividadID INT,
    FechaHoraRegistro DATETIME,
    -- Respuestas del usuario a la actividad (puedes usar un campo de texto o estructura de datos adecuada)
    Respuestas TEXT,
    -- Calificaciones si es aplicable
    Calificaciones FLOAT
);

-- Tabla de Perfiles
CREATE TABLE Perfiles (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    UsuarioID INT,
    -- Otra información de perfil del usuario (por ejemplo, intereses, objetivos de aprendizaje, logros)
    InformacionPerfil TEXT
);

-- Definición de las claves foráneas
ALTER TABLE Actividades ADD FOREIGN KEY (EstiloAprendizajeID) REFERENCES EstilosAprendizaje(ID);
ALTER TABLE Actividades ADD FOREIGN KEY (ProfesorID) REFERENCES Profesores(ID);
ALTER TABLE RegistrosActividades ADD FOREIGN KEY (UsuarioID) REFERENCES Usuarios(ID);
ALTER TABLE RegistrosActividades ADD FOREIGN KEY (ActividadID) REFERENCES Actividades(ID);
ALTER TABLE Perfiles ADD FOREIGN KEY (UsuarioID) REFERENCES Usuarios(ID);
