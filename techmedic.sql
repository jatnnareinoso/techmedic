-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2024 a las 15:16:12
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `techmedic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `id_consulta` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_doctor` int(11) DEFAULT NULL,
  `fecha_consulta` datetime NOT NULL,
  `diagnostico` varchar(50) NOT NULL,
  `tratamiento` varchar(100) NOT NULL,
  `cita` date DEFAULT NULL,
  `observacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`id_consulta`, `id_paciente`, `id_doctor`, `fecha_consulta`, `diagnostico`, `tratamiento`, `cita`, `observacion`) VALUES
(3, 1, 1, '2023-10-12 17:42:20', 'Presión alta', 'Tomar Aloten L 5/10mg', '2023-11-12', 'Ninguna'),
(5, 3, 1, '2023-10-10 17:50:30', 'Nivel de azucar alto', 'Tomar Glipox Met 50/850mg', '2023-11-10', 'Ingerir comida baja de azucar'),
(7, 3, 5, '2023-10-10 17:58:40', 'Presenta fuerte fiebre y dolores de cabeza', 'Tomar Acetaminofen 500mg MK y Sumigran Plus', '2023-10-12', 'Ninguna'),
(8, 3, 7, '2023-12-06 00:00:00', 'Presión alta', 'Tomar Aloten L 5/10mg', '2024-01-06', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `id_doctor` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(50) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `cedula` varchar(13) NOT NULL,
  `colegiatura` varchar(10) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `lugar_trabajo` varchar(30) NOT NULL,
  `seguro` varchar(30) DEFAULT NULL,
  `estudio_sec` varchar(30) NOT NULL,
  `universidad` varchar(30) NOT NULL,
  `especialidad_uni` varchar(30) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `curso` varchar(30) DEFAULT NULL,
  `experiencia` varchar(30) DEFAULT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`id_doctor`, `nombre`, `apellido`, `fecha_nacimiento`, `correo`, `sexo`, `telefono`, `cedula`, `colegiatura`, `id_especialidad`, `lugar_trabajo`, `seguro`, `estudio_sec`, `universidad`, `especialidad_uni`, `titulo`, `curso`, `experiencia`, `nacionalidad`, `provincia`, `ciudad`, `direccion`, `pass`) VALUES
(1, 'Juan Carlos ', 'Reinoso Serrata', '1978-01-26', 'carlos@gmail.com', 'Masculino', '8095104453', '04713698455', '17031', 4, 'Quinto Centenario', 'ARS SENASA', 'Escuela García Godoy', 'UCATECI', 'Cirugía General', 'Médico', 'Ninguno', '20 años', 'Dominicano', 'La Vega', 'La Vega', 'Residencial Armida', 'Carlos1234'),
(2, 'Julio Cesar', 'Rosa Amparo', '1972-02-12', 'julio@gmail.com', 'Masculino', '8096942712', '04729470120', '13405', 3, 'Clínica Baez Soto', 'male', 'Escuela García Godoy', 'UCATECI', 'Medicina Interna', 'Médico', 'Ninguno', '25 años', 'Dominicano', 'La Vega', 'La Vega', 'Residencial Armida', 'Julio1234'),
(3, 'Elizabeth Ileana', 'Báez Vásquez ', '1989-07-31', 'elibae@gmail.com', 'Femenino', '8495551634', '047024862002', '12345', 2, 'Clínica Baez Soto', 'ARS SENASA', 'Escuela García Godoy', 'UCATECI', 'Pediatría', 'Médico', 'Ninguno', '10 años', 'Dominicana', 'La Vega', 'La Vega', 'Sector La Primavera', 'Elizabeth1234'),
(4, 'Belkis ', 'Báez Vasquez', '1988-05-30', 'belkis@gmail.com', 'Femenino', '8095732737', '04724860346', '12453', 5, 'Clínica Baez Soto', 'ARS Yunen', 'Escuela García Godoy', 'UASD', 'Ginecología y Obstetricia', 'Médico', 'Ninguno', '12 años', 'Dominicana', 'La Vega', 'La Vega', 'Residencial Armida', 'Belkis1234'),
(5, 'Milagros', 'Valdez', '1980-06-20', 'milagros@gmail.com', 'Femenino', '8094274859', '04712345638', '25389', 1, 'Clínica Baez Soto', 'ARS HUMANO', 'P.F.M.M', 'UCATECI', 'Medicina General', 'Médico', 'Ninguno', '15 años', 'Dominicana', 'La Vega', 'La Vega', 'Las Carolinas', 'Milagros1234'),
(6, 'Juan Ramon', 'Reinoso Serrata', '1980-10-10', 'juan@gmail.com', 'Masculino', '8095104453', '134323', '132431', 1, 'Quinto Centenario', 'ARS HUMANO', 'Escuela García Godoy', 'UCATECI', 'Medicina General', 'Médico', 'Ninguno', '15 años', 'Dominicana', 'La Vega', 'La Vega', 'Residencial Armida', 'Juan1234'),
(7, 'Pedro', 'Reinoso Serrata', '1980-02-20', 'pedro@gmail.com', 'Masculino', '8095104453', '047123452869', '12345', 6, 'Quinto Centenario', 'ARS HUMANO', 'Escuela García Godoy', 'UCATECI', 'Cardiología', 'Médico', 'Ninguno', '20 años', 'Dominicano', 'La Vega', 'La Vega', 'Residencial Armida', 'Pedro1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE `enfermedad` (
  `id_enfermedad` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `sintomas` varchar(100) NOT NULL,
  `tratamiento` varchar(100) NOT NULL,
  `observacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`id_enfermedad`, `nombre`, `sintomas`, `tratamiento`, `observacion`) VALUES
(1, 'Gripe', 'Fiebre, escalofríos, dolores musculares.', 'Reposo, tomar Defensol antigripal, ', 'Infección viral que afecta el sistema respiratorio'),
(2, 'Ameba', 'Problemas intestinales', 'Tomar Albendameba', 'Continuar tratamiento por 3 días '),
(3, 'Diabetes', 'Nivel alto de azúcar', 'Tomar Glucox 850mg', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL,
  `especialidad` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `observacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `especialidad`, `descripcion`, `observacion`) VALUES
(1, 'Medicina General', 'Primer nivel de atención médica que realiza procedimientos sencillos y habitualmente se realiza en c', NULL),
(2, 'Pediatría', 'Especialidad médica enfocada en la atención de los niños desde su nacimiento hasta la adolescencia.', NULL),
(3, 'Medicina Interna', 'Enfocada en el diagnóstico y tratamiento de enfermedades en adultos.', NULL),
(4, 'Cirugía General', 'Realiza procedimientos quirúrgicos comunes y aborda problemas quirúrgicos generales.', NULL),
(5, 'Ginecología y Obstetricia', 'Se ocupa de la salud reproductiva de las mujeres, incluido el embarazo y el parto', NULL),
(6, 'Cardiología', 'Especializada en el diagnóstico y tratamiento de enfermedades del corazón.', NULL),
(7, 'Dermatología', 'Trata enfermedades de la piel, cabello y uñas, así como problemas dermatológicos.', NULL),
(8, 'Neurología', 'Se enfoca en el sistema nervioso, tratando trastornos neurológicos y del cerebro.', NULL),
(9, 'Psiquiatría', 'Diagnóstico y tratamiento de trastornos mentales y emocionales.', NULL),
(10, 'Oftalmología', 'Cuida la salud ocular y trata enfermedades relacionadas con los ojos.', NULL),
(11, 'Otorrinolaringología', 'Especialidad en oído, nariz, garganta y estructuras relacionadas.', NULL),
(12, 'Ortopedia', 'Trata problemas musculoesqueléticos, huesos y articulaciones.', NULL),
(13, 'Urología', 'Enfocada en el sistema urinario y problemas relacionados con el tracto genital masculino.', NULL),
(14, 'Endocrinología', 'Trata trastornos hormonales y desequilibrios en el sistema endocrino.', NULL),
(15, 'Oncología', 'Especialidad en el diagnóstico y tratamiento del cáncer.', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `id_historia_clinica` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_doctor` int(11) DEFAULT NULL,
  `antecedentes` varchar(100) NOT NULL,
  `resultados` varchar(100) NOT NULL,
  `id_enfermedad` int(11) DEFAULT NULL,
  `observacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historia_clinica`
--

INSERT INTO `historia_clinica` (`id_historia_clinica`, `id_paciente`, `fecha_registro`, `id_doctor`, `antecedentes`, `resultados`, `id_enfermedad`, `observacion`) VALUES
(1, 4, '2023-12-06 22:05:50', 1, 'Problemas respiratorios', 'Deficiencia en respiración por sufrir constantemente de Gripe', 1, 'Ninguna'),
(2, 4, '2023-12-06 23:40:12', 5, 'Ninguno', 'Debe continuar tratamiento por 3 días más, ya que no le ha hecho efecto el medicamento. ', 2, 'Ninguna'),
(3, 1, '2023-12-06 11:12:28', 1, 'Padece de presión alta', 'Por motivos de la gripe, su presión se ha visto afectada', 1, 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `id_emisor` int(11) DEFAULT NULL,
  `id_receptor` int(11) DEFAULT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `contenido` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `id_emisor`, `id_receptor`, `fecha_envio`, `contenido`) VALUES
(1, 1, 1, '2023-12-06 20:44:20', 'Recuerda tomar Aloten L 5/10mg, después del desayuno.\r\n'),
(2, 1, 3, '2023-12-06 23:29:34', 'Tomar Glucox 850mg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(50) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `cedula` varchar(13) NOT NULL,
  `ocupacion` varchar(30) DEFAULT NULL,
  `seguro` varchar(30) DEFAULT NULL,
  `sangre` varchar(30) DEFAULT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `familiar_nombre` varchar(50) NOT NULL,
  `familiar_apellido` varchar(50) NOT NULL,
  `familiar_direccion` varchar(50) DEFAULT NULL,
  `familiar_correo` varchar(50) DEFAULT NULL,
  `familiar_telefono` varchar(12) DEFAULT NULL,
  `pass` varchar(20) NOT NULL,
  `observacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `nombre`, `apellido`, `fecha_nacimiento`, `correo`, `sexo`, `telefono`, `cedula`, `ocupacion`, `seguro`, `sangre`, `nacionalidad`, `provincia`, `ciudad`, `direccion`, `familiar_nombre`, `familiar_apellido`, `familiar_direccion`, `familiar_correo`, `familiar_telefono`, `pass`, `observacion`) VALUES
(1, 'Jatnna', 'Reinoso', '2002-12-02', 'jatnnar@gmail.com', 'female', '8096942712', '40213698455', 'Estudiante', 'ARS SENASA', 'O-', 'Dominicana', 'La Vega', 'La Vega', 'Residencial Concordia', 'Altagracia Clarissia', 'Serrata Rodriguez', 'Residencial Concordia', 'clarisia@gmail.com', '8096611764', 'Jatnna123', NULL),
(3, 'Pamela', 'Abreu', '2002-09-06', 'pamela@gmail.com', 'female', '8293456789', '40212345678', 'Estudiante', 'ARS PRIMERA', 'A+', 'Dominicana', 'La Vega', 'La Vega', 'Residencial Omelia', 'Pablo', 'Abreu ', 'Residencial Omelia', 'pablo@gmail.com', '8095731234', 'Pamela123', NULL),
(4, 'Barry', 'Weydex', '1999-06-15', 'barry@gmail.com', 'male', '8496942712', '40212345534', 'Farmacéutico ', 'ARS SENASA', 'A+', 'Dominicano', 'La Vega', 'La Vega', 'Residencial Omelia', 'Teodoro', 'Ruiz Palacios', 'Residencial Omelia', 'teodoro@gmail.com', '8496942711', 'Barry123', NULL),
(5, 'Moisés Ricardo', 'Zabala Bueno', '2002-09-23', 'moises@gmail.com', 'male', '8091234567', '40216849257', 'Estudiante', 'ARS HUMANO', '0+', 'Dominicano', 'Monseñor Nouel', 'Bonao', 'Bonao', 'Patricia', 'Bueno', 'Bonao', 'patricia@gmail.com', '8095735555', 'Moises123', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id_doctor`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`id_enfermedad`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia_clinica`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_enfermedad` (`id_enfermedad`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_emisor` (`id_emisor`),
  ADD KEY `id_receptor` (`id_receptor`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia_clinica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`),
  ADD CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`);

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`);

--
-- Filtros para la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`),
  ADD CONSTRAINT `historia_clinica_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`),
  ADD CONSTRAINT `historia_clinica_ibfk_3` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedad` (`id_enfermedad`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_emisor`) REFERENCES `doctor` (`id_doctor`),
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`id_receptor`) REFERENCES `paciente` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
