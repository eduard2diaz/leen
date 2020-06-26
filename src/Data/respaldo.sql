PGDMP                         x        	   leen_last "   10.13 (Ubuntu 10.13-1.pgdg18.04+1)     12.3 (Ubuntu 12.3-1.pgdg18.04+1) �    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    58518 	   leen_last    DATABASE     {   CREATE DATABASE leen_last WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_MX.UTF-8' LC_CTYPE = 'es_MX.UTF-8';
    DROP DATABASE leen_last;
                postgres    false            �            1259    58643    condicion_docente_educativa    TABLE       CREATE TABLE public.condicion_docente_educativa (
    id integer NOT NULL,
    diagnostico_id integer NOT NULL,
    grado_id integer NOT NULL,
    escuela_id integer NOT NULL,
    curp character varying(18) NOT NULL,
    nombre character varying(50) NOT NULL
);
 /   DROP TABLE public.condicion_docente_educativa;
       public            postgres    false            �            1259    58681 "   condicion_docente_educativa_id_seq    SEQUENCE     �   CREATE SEQUENCE public.condicion_docente_educativa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.condicion_docente_educativa_id_seq;
       public          postgres    false            �            1259    58583    condicion_educativa_alumnos    TABLE     �   CREATE TABLE public.condicion_educativa_alumnos (
    id integer NOT NULL,
    diagnostico_id integer NOT NULL,
    grado_id integer NOT NULL,
    escuela_id integer NOT NULL,
    numalumnas integer NOT NULL,
    numalumnos integer NOT NULL
);
 /   DROP TABLE public.condicion_educativa_alumnos;
       public            postgres    false            �            1259    58663 "   condicion_educativa_alumnos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.condicion_educativa_alumnos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.condicion_educativa_alumnos_id_seq;
       public          postgres    false            �            1259    58540    control_gastos    TABLE     J  CREATE TABLE public.control_gastos (
    id integer NOT NULL,
    proyecto_id integer NOT NULL,
    tipo_comprobante_id integer NOT NULL,
    fechacaptura date NOT NULL,
    concepto text NOT NULL,
    numerocomprobante integer NOT NULL,
    monto double precision NOT NULL,
    controlarchivos character varying(255) NOT NULL
);
 "   DROP TABLE public.control_gastos;
       public            postgres    false            �            1259    58655    control_gastos_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.control_gastos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.control_gastos_id_seq;
       public          postgres    false            �            1259    58561    diagnostico_plantel    TABLE     �  CREATE TABLE public.diagnostico_plantel (
    id integer NOT NULL,
    plantel_id integer NOT NULL,
    idcondiciones_aula_id integer NOT NULL,
    idcondicionessanitarios_id integer NOT NULL,
    idcondicionoficina_id integer NOT NULL,
    idcondicionesbliblioteca_id integer NOT NULL,
    idcondicionaulamedios_id integer NOT NULL,
    idcondicionpatio_id integer NOT NULL,
    idcondicioncanchasdeportivas_id integer NOT NULL,
    idcondicionbarda_id integer NOT NULL,
    idcondicionagua_id integer NOT NULL,
    idcondiciondrenaje_id integer NOT NULL,
    idcondicionenergia_id integer NOT NULL,
    idcondiciontelefono_id integer NOT NULL,
    idcondicioninternet_id integer NOT NULL,
    numeroaulas integer NOT NULL,
    numerosanitarios integer NOT NULL,
    numerooficinas integer NOT NULL,
    numerobibliotecas integer NOT NULL,
    numeroaulasmedios integer NOT NULL,
    numeropatio integer NOT NULL,
    numerocanchasdeportivas integer NOT NULL,
    numerobarda integer NOT NULL,
    aguapotable boolean NOT NULL,
    drenaje boolean NOT NULL,
    energiaelectrica boolean NOT NULL,
    telefono boolean NOT NULL,
    internet boolean NOT NULL,
    iddiagnosticoplantel integer NOT NULL,
    diagnosticoarchivo character varying(255) NOT NULL,
    fecha date NOT NULL,
    descrip_num_aulas text,
    descrip_num_sanitarios text,
    descrip_num_oficinas text,
    descrip_num_bibliotecas text,
    descrip_num_aulamedios text,
    descrip_num_patios text,
    descrip_num_canchas_deportivas text,
    descrip_num_bardas text,
    descrip_agua_potables text,
    descrip_drenaje text,
    descrip_energiaelectrica text,
    descrip_telefonia text,
    descrip_internet text
);
 '   DROP TABLE public.diagnostico_plantel;
       public            postgres    false            �            1259    58661    diagnostico_plantel_id_seq    SEQUENCE     �   CREATE SEQUENCE public.diagnostico_plantel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.diagnostico_plantel_id_seq;
       public          postgres    false            �            1259    58527    escuela    TABLE     �   CREATE TABLE public.escuela (
    id integer NOT NULL,
    plantel_id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    ccts character varying(10) NOT NULL
);
    DROP TABLE public.escuela;
       public            postgres    false            �            1259    58653    escuela_id_seq    SEQUENCE     w   CREATE SEQUENCE public.escuela_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.escuela_id_seq;
       public          postgres    false            �            1259    58533    escuela_tipo_ensenanza    TABLE     x   CREATE TABLE public.escuela_tipo_ensenanza (
    escuela_id integer NOT NULL,
    tipo_ensenanza_id integer NOT NULL
);
 *   DROP TABLE public.escuela_tipo_ensenanza;
       public            postgres    false            �            1259    58550    plantel    TABLE     �   CREATE TABLE public.plantel (
    id integer NOT NULL,
    tipoasentamiento_id integer,
    nombre character varying(255) NOT NULL
);
    DROP TABLE public.plantel;
       public            postgres    false            �            1259    58619    proyecto    TABLE     �   CREATE TABLE public.proyecto (
    id integer NOT NULL,
    plantel_id integer NOT NULL,
    fechainicio date NOT NULL,
    fechafin date,
    montoasignado double precision NOT NULL,
    numero character varying(10) NOT NULL
);
    DROP TABLE public.proyecto;
       public            postgres    false            �            1259    58844    escuelas_con_proyecto_view    VIEW       CREATE VIEW public.escuelas_con_proyecto_view AS
 SELECT e.id,
    e.nombre,
    e.ccts,
    p.nombre AS plantel
   FROM ((public.escuela e
     JOIN public.plantel p ON ((p.id = e.plantel_id)))
     JOIN public.proyecto ON ((proyecto.plantel_id = p.id)));
 -   DROP VIEW public.escuelas_con_proyecto_view;
       public          postgres    false    197    197    197    197    200    200    209            �            1259    58556    estatus    TABLE     �   CREATE TABLE public.estatus (
    id integer NOT NULL,
    estatus character varying(250) NOT NULL,
    code integer NOT NULL
);
    DROP TABLE public.estatus;
       public            postgres    false            �            1259    58659    estatus_id_seq    SEQUENCE     w   CREATE SEQUENCE public.estatus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.estatus_id_seq;
       public          postgres    false            �            1259    58613    grado_ensenanza    TABLE     �   CREATE TABLE public.grado_ensenanza (
    id integer NOT NULL,
    tipoensenanza_id integer NOT NULL,
    nombre character varying(30) NOT NULL
);
 #   DROP TABLE public.grado_ensenanza;
       public            postgres    false            �            1259    58673    grado_ensenanza_id_seq    SEQUENCE        CREATE SEQUENCE public.grado_ensenanza_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.grado_ensenanza_id_seq;
       public          postgres    false            �            1259    58625    plan_trabajo    TABLE     �  CREATE TABLE public.plan_trabajo (
    id integer NOT NULL,
    proyecto_id integer NOT NULL,
    tipo_accion_id integer NOT NULL,
    fechacaptura date NOT NULL,
    descripcionaccion text NOT NULL,
    tiempoestimado character varying(50) NOT NULL,
    costoestimado double precision NOT NULL,
    totalrecursosasignados double precision NOT NULL,
    planarchivo character varying(255) NOT NULL
);
     DROP TABLE public.plan_trabajo;
       public            postgres    false            �            1259    58677    plan_trabajo_id_seq    SEQUENCE     |   CREATE SEQUENCE public.plan_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.plan_trabajo_id_seq;
       public          postgres    false            �            1259    58657    plantel_id_seq    SEQUENCE     w   CREATE SEQUENCE public.plantel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.plantel_id_seq;
       public          postgres    false            �            1259    58852    planteles_con_proyecto_view    VIEW     �   CREATE VIEW public.planteles_con_proyecto_view AS
 SELECT p.id,
    p.nombre
   FROM (public.plantel p
     JOIN public.proyecto ON ((proyecto.plantel_id = p.id)));
 .   DROP VIEW public.planteles_con_proyecto_view;
       public          postgres    false    200    200    209            �            1259    58870    planteles_sin_aguapotable_view    VIEW     �  CREATE VIEW public.planteles_sin_aguapotable_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.aguapotable = false));
 1   DROP VIEW public.planteles_sin_aguapotable_view;
       public          postgres    false    200    200    202    202    202            �            1259    58865    planteles_sin_bibliotecas_view    VIEW     �  CREATE VIEW public.planteles_sin_bibliotecas_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.numerobibliotecas = 0));
 1   DROP VIEW public.planteles_sin_bibliotecas_view;
       public          postgres    false    200    200    202    202    202            �            1259    58875    planteles_sin_drenaje_view    VIEW     �  CREATE VIEW public.planteles_sin_drenaje_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.drenaje = false));
 -   DROP VIEW public.planteles_sin_drenaje_view;
       public          postgres    false    200    200    202    202    202            �            1259    58880    planteles_sin_electricidad_view    VIEW     �  CREATE VIEW public.planteles_sin_electricidad_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.energiaelectrica = false));
 2   DROP VIEW public.planteles_sin_electricidad_view;
       public          postgres    false    200    200    202    202    202            �            1259    58885    planteles_sin_internet_view    VIEW     �  CREATE VIEW public.planteles_sin_internet_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.internet = false));
 .   DROP VIEW public.planteles_sin_internet_view;
       public          postgres    false    200    200    202    202    202            �            1259    58860    planteles_sin_sanitarios_view    VIEW     �  CREATE VIEW public.planteles_sin_sanitarios_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.numerosanitarios = 0));
 0   DROP VIEW public.planteles_sin_sanitarios_view;
       public          postgres    false    200    200    202    202    202            �            1259    58675    proyecto_id_seq    SEQUENCE     x   CREATE SEQUENCE public.proyecto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.proyecto_id_seq;
       public          postgres    false            �            1259    58601    rendicion_cuentas    TABLE       CREATE TABLE public.rendicion_cuentas (
    id integer NOT NULL,
    proyecto_id integer NOT NULL,
    tipo_accion_id integer NOT NULL,
    fechacaptura date NOT NULL,
    monto double precision NOT NULL,
    rendicionesarchivos character varying(255) NOT NULL
);
 %   DROP TABLE public.rendicion_cuentas;
       public            postgres    false            �            1259    58669    rendicion_cuentas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rendicion_cuentas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.rendicion_cuentas_id_seq;
       public          postgres    false            �            1259    58635    tipo_accion    TABLE     �   CREATE TABLE public.tipo_accion (
    id integer NOT NULL,
    accion character varying(200) NOT NULL,
    descripcion text NOT NULL,
    fechacaptura date NOT NULL
);
    DROP TABLE public.tipo_accion;
       public            postgres    false            �            1259    58679    tipo_accion_id_seq    SEQUENCE     {   CREATE SEQUENCE public.tipo_accion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tipo_accion_id_seq;
       public          postgres    false            �            1259    58596    tipo_asentamiento    TABLE     �   CREATE TABLE public.tipo_asentamiento (
    id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    clave integer NOT NULL
);
 %   DROP TABLE public.tipo_asentamiento;
       public            postgres    false            �            1259    58667    tipo_asentamiento_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_asentamiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.tipo_asentamiento_id_seq;
       public          postgres    false            �            1259    58519    tipo_comprobante    TABLE     �   CREATE TABLE public.tipo_comprobante (
    id integer NOT NULL,
    comprobante character varying(50) NOT NULL,
    descripcion text NOT NULL,
    fechacaptura date NOT NULL
);
 $   DROP TABLE public.tipo_comprobante;
       public            postgres    false            �            1259    58651    tipo_comprobante_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_comprobante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tipo_comprobante_id_seq;
       public          postgres    false            �            1259    58608    tipo_condicion    TABLE     n   CREATE TABLE public.tipo_condicion (
    id integer NOT NULL,
    condicion character varying(50) NOT NULL
);
 "   DROP TABLE public.tipo_condicion;
       public            postgres    false            �            1259    58671    tipo_condicion_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.tipo_condicion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tipo_condicion_id_seq;
       public          postgres    false            �            1259    58591    tipo_ensenanza    TABLE     k   CREATE TABLE public.tipo_ensenanza (
    id integer NOT NULL,
    nombre character varying(40) NOT NULL
);
 "   DROP TABLE public.tipo_ensenanza;
       public            postgres    false            �            1259    58665    tipo_ensenanza_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.tipo_ensenanza_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tipo_ensenanza_id_seq;
       public          postgres    false            �            1259    58848    total_escuelas_view    VIEW     a   CREATE VIEW public.total_escuelas_view AS
 SELECT count(e.id) AS count
   FROM public.escuela e;
 &   DROP VIEW public.total_escuelas_view;
       public          postgres    false    197            �            1259    58856    total_planteles_view    VIEW     b   CREATE VIEW public.total_planteles_view AS
 SELECT count(e.id) AS count
   FROM public.plantel e;
 '   DROP VIEW public.total_planteles_view;
       public          postgres    false    200            �          0    58643    condicion_docente_educativa 
   TABLE DATA           m   COPY public.condicion_docente_educativa (id, diagnostico_id, grado_id, escuela_id, curp, nombre) FROM stdin;
    public          postgres    false    212   ��       �          0    58583    condicion_educativa_alumnos 
   TABLE DATA           w   COPY public.condicion_educativa_alumnos (id, diagnostico_id, grado_id, escuela_id, numalumnas, numalumnos) FROM stdin;
    public          postgres    false    203   ��       }          0    58540    control_gastos 
   TABLE DATA           �   COPY public.control_gastos (id, proyecto_id, tipo_comprobante_id, fechacaptura, concepto, numerocomprobante, monto, controlarchivos) FROM stdin;
    public          postgres    false    199   ��       �          0    58561    diagnostico_plantel 
   TABLE DATA           �  COPY public.diagnostico_plantel (id, plantel_id, idcondiciones_aula_id, idcondicionessanitarios_id, idcondicionoficina_id, idcondicionesbliblioteca_id, idcondicionaulamedios_id, idcondicionpatio_id, idcondicioncanchasdeportivas_id, idcondicionbarda_id, idcondicionagua_id, idcondiciondrenaje_id, idcondicionenergia_id, idcondiciontelefono_id, idcondicioninternet_id, numeroaulas, numerosanitarios, numerooficinas, numerobibliotecas, numeroaulasmedios, numeropatio, numerocanchasdeportivas, numerobarda, aguapotable, drenaje, energiaelectrica, telefono, internet, iddiagnosticoplantel, diagnosticoarchivo, fecha, descrip_num_aulas, descrip_num_sanitarios, descrip_num_oficinas, descrip_num_bibliotecas, descrip_num_aulamedios, descrip_num_patios, descrip_num_canchas_deportivas, descrip_num_bardas, descrip_agua_potables, descrip_drenaje, descrip_energiaelectrica, descrip_telefonia, descrip_internet) FROM stdin;
    public          postgres    false    202   �       {          0    58527    escuela 
   TABLE DATA           ?   COPY public.escuela (id, plantel_id, nombre, ccts) FROM stdin;
    public          postgres    false    197   ,�       |          0    58533    escuela_tipo_ensenanza 
   TABLE DATA           O   COPY public.escuela_tipo_ensenanza (escuela_id, tipo_ensenanza_id) FROM stdin;
    public          postgres    false    198   I�                 0    58556    estatus 
   TABLE DATA           4   COPY public.estatus (id, estatus, code) FROM stdin;
    public          postgres    false    201   f�       �          0    58613    grado_ensenanza 
   TABLE DATA           G   COPY public.grado_ensenanza (id, tipoensenanza_id, nombre) FROM stdin;
    public          postgres    false    208   ��       �          0    58625    plan_trabajo 
   TABLE DATA           �   COPY public.plan_trabajo (id, proyecto_id, tipo_accion_id, fechacaptura, descripcionaccion, tiempoestimado, costoestimado, totalrecursosasignados, planarchivo) FROM stdin;
    public          postgres    false    210   �       ~          0    58550    plantel 
   TABLE DATA           B   COPY public.plantel (id, tipoasentamiento_id, nombre) FROM stdin;
    public          postgres    false    200    �       �          0    58619    proyecto 
   TABLE DATA           `   COPY public.proyecto (id, plantel_id, fechainicio, fechafin, montoasignado, numero) FROM stdin;
    public          postgres    false    209   =�       �          0    58601    rendicion_cuentas 
   TABLE DATA           v   COPY public.rendicion_cuentas (id, proyecto_id, tipo_accion_id, fechacaptura, monto, rendicionesarchivos) FROM stdin;
    public          postgres    false    206   Z�       �          0    58635    tipo_accion 
   TABLE DATA           L   COPY public.tipo_accion (id, accion, descripcion, fechacaptura) FROM stdin;
    public          postgres    false    211   w�       �          0    58596    tipo_asentamiento 
   TABLE DATA           >   COPY public.tipo_asentamiento (id, nombre, clave) FROM stdin;
    public          postgres    false    205   ��       z          0    58519    tipo_comprobante 
   TABLE DATA           V   COPY public.tipo_comprobante (id, comprobante, descripcion, fechacaptura) FROM stdin;
    public          postgres    false    196   �       �          0    58608    tipo_condicion 
   TABLE DATA           7   COPY public.tipo_condicion (id, condicion) FROM stdin;
    public          postgres    false    207   ��       �          0    58591    tipo_ensenanza 
   TABLE DATA           4   COPY public.tipo_ensenanza (id, nombre) FROM stdin;
    public          postgres    false    204   %�       �           0    0 "   condicion_docente_educativa_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.condicion_docente_educativa_id_seq', 2, true);
          public          postgres    false    228            �           0    0 "   condicion_educativa_alumnos_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.condicion_educativa_alumnos_id_seq', 1, true);
          public          postgres    false    219            �           0    0    control_gastos_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.control_gastos_id_seq', 1, true);
          public          postgres    false    215            �           0    0    diagnostico_plantel_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.diagnostico_plantel_id_seq', 1, true);
          public          postgres    false    218            �           0    0    escuela_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.escuela_id_seq', 1, true);
          public          postgres    false    214            �           0    0    estatus_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.estatus_id_seq', 6, true);
          public          postgres    false    217            �           0    0    grado_ensenanza_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.grado_ensenanza_id_seq', 20, true);
          public          postgres    false    224            �           0    0    plan_trabajo_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.plan_trabajo_id_seq', 1, true);
          public          postgres    false    226            �           0    0    plantel_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.plantel_id_seq', 3, true);
          public          postgres    false    216            �           0    0    proyecto_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.proyecto_id_seq', 1, true);
          public          postgres    false    225            �           0    0    rendicion_cuentas_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.rendicion_cuentas_id_seq', 1, true);
          public          postgres    false    222            �           0    0    tipo_accion_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.tipo_accion_id_seq', 6, true);
          public          postgres    false    227            �           0    0    tipo_asentamiento_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tipo_asentamiento_id_seq', 1, true);
          public          postgres    false    221            �           0    0    tipo_comprobante_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.tipo_comprobante_id_seq', 6, true);
          public          postgres    false    213            �           0    0    tipo_condicion_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tipo_condicion_id_seq', 6, true);
          public          postgres    false    223            �           0    0    tipo_ensenanza_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tipo_ensenanza_id_seq', 6, true);
          public          postgres    false    220            �           2606    58647 <   condicion_docente_educativa condicion_docente_educativa_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT condicion_docente_educativa_pkey PRIMARY KEY (id);
 f   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT condicion_docente_educativa_pkey;
       public            postgres    false    212            �           2606    58587 <   condicion_educativa_alumnos condicion_educativa_alumnos_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT condicion_educativa_alumnos_pkey PRIMARY KEY (id);
 f   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT condicion_educativa_alumnos_pkey;
       public            postgres    false    203            �           2606    58547 "   control_gastos control_gastos_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.control_gastos
    ADD CONSTRAINT control_gastos_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.control_gastos DROP CONSTRAINT control_gastos_pkey;
       public            postgres    false    199            �           2606    58568 ,   diagnostico_plantel diagnostico_plantel_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT diagnostico_plantel_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT diagnostico_plantel_pkey;
       public            postgres    false    202            �           2606    58531    escuela escuela_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.escuela
    ADD CONSTRAINT escuela_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.escuela DROP CONSTRAINT escuela_pkey;
       public            postgres    false    197            �           2606    58537 2   escuela_tipo_ensenanza escuela_tipo_ensenanza_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.escuela_tipo_ensenanza
    ADD CONSTRAINT escuela_tipo_ensenanza_pkey PRIMARY KEY (escuela_id, tipo_ensenanza_id);
 \   ALTER TABLE ONLY public.escuela_tipo_ensenanza DROP CONSTRAINT escuela_tipo_ensenanza_pkey;
       public            postgres    false    198    198            �           2606    58560    estatus estatus_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.estatus
    ADD CONSTRAINT estatus_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.estatus DROP CONSTRAINT estatus_pkey;
       public            postgres    false    201            �           2606    58617 $   grado_ensenanza grado_ensenanza_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.grado_ensenanza
    ADD CONSTRAINT grado_ensenanza_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.grado_ensenanza DROP CONSTRAINT grado_ensenanza_pkey;
       public            postgres    false    208            �           2606    58632    plan_trabajo plan_trabajo_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.plan_trabajo
    ADD CONSTRAINT plan_trabajo_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.plan_trabajo DROP CONSTRAINT plan_trabajo_pkey;
       public            postgres    false    210            �           2606    58554    plantel plantel_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.plantel
    ADD CONSTRAINT plantel_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.plantel DROP CONSTRAINT plantel_pkey;
       public            postgres    false    200            �           2606    58623    proyecto proyecto_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT proyecto_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.proyecto DROP CONSTRAINT proyecto_pkey;
       public            postgres    false    209            �           2606    58605 (   rendicion_cuentas rendicion_cuentas_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.rendicion_cuentas
    ADD CONSTRAINT rendicion_cuentas_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.rendicion_cuentas DROP CONSTRAINT rendicion_cuentas_pkey;
       public            postgres    false    206            �           2606    58642    tipo_accion tipo_accion_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tipo_accion
    ADD CONSTRAINT tipo_accion_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.tipo_accion DROP CONSTRAINT tipo_accion_pkey;
       public            postgres    false    211            �           2606    58600 (   tipo_asentamiento tipo_asentamiento_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tipo_asentamiento
    ADD CONSTRAINT tipo_asentamiento_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.tipo_asentamiento DROP CONSTRAINT tipo_asentamiento_pkey;
       public            postgres    false    205            �           2606    58526 &   tipo_comprobante tipo_comprobante_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.tipo_comprobante
    ADD CONSTRAINT tipo_comprobante_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.tipo_comprobante DROP CONSTRAINT tipo_comprobante_pkey;
       public            postgres    false    196            �           2606    58612 "   tipo_condicion tipo_condicion_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tipo_condicion
    ADD CONSTRAINT tipo_condicion_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.tipo_condicion DROP CONSTRAINT tipo_condicion_pkey;
       public            postgres    false    207            �           2606    58595 "   tipo_ensenanza tipo_ensenanza_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tipo_ensenanza
    ADD CONSTRAINT tipo_ensenanza_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.tipo_ensenanza DROP CONSTRAINT tipo_ensenanza_pkey;
       public            postgres    false    204            �           1259    58549    idx_141b8c4ca9b5e49a    INDEX     ^   CREATE INDEX idx_141b8c4ca9b5e49a ON public.control_gastos USING btree (tipo_comprobante_id);
 (   DROP INDEX public.idx_141b8c4ca9b5e49a;
       public            postgres    false    199            �           1259    58548    idx_141b8c4cf625d1ba    INDEX     V   CREATE INDEX idx_141b8c4cf625d1ba ON public.control_gastos USING btree (proyecto_id);
 (   DROP INDEX public.idx_141b8c4cf625d1ba;
       public            postgres    false    199            �           1259    58539    idx_17fbbcc02f92be1    INDEX     c   CREATE INDEX idx_17fbbcc02f92be1 ON public.escuela_tipo_ensenanza USING btree (tipo_ensenanza_id);
 '   DROP INDEX public.idx_17fbbcc02f92be1;
       public            postgres    false    198            �           1259    58538    idx_17fbbcc0e33f8867    INDEX     ]   CREATE INDEX idx_17fbbcc0e33f8867 ON public.escuela_tipo_ensenanza USING btree (escuela_id);
 (   DROP INDEX public.idx_17fbbcc0e33f8867;
       public            postgres    false    198            �           1259    58648    idx_1cea54b77a94ba1a    INDEX     f   CREATE INDEX idx_1cea54b77a94ba1a ON public.condicion_docente_educativa USING btree (diagnostico_id);
 (   DROP INDEX public.idx_1cea54b77a94ba1a;
       public            postgres    false    212            �           1259    58649    idx_1cea54b791a441cc    INDEX     `   CREATE INDEX idx_1cea54b791a441cc ON public.condicion_docente_educativa USING btree (grado_id);
 (   DROP INDEX public.idx_1cea54b791a441cc;
       public            postgres    false    212            �           1259    58650    idx_1cea54b7e33f8867    INDEX     b   CREATE INDEX idx_1cea54b7e33f8867 ON public.condicion_docente_educativa USING btree (escuela_id);
 (   DROP INDEX public.idx_1cea54b7e33f8867;
       public            postgres    false    212            �           1259    58618    idx_2877888eda33e9e7    INDEX     \   CREATE INDEX idx_2877888eda33e9e7 ON public.grado_ensenanza USING btree (tipoensenanza_id);
 (   DROP INDEX public.idx_2877888eda33e9e7;
       public            postgres    false    208            �           1259    58634    idx_4369f002dd25ed3b    INDEX     W   CREATE INDEX idx_4369f002dd25ed3b ON public.plan_trabajo USING btree (tipo_accion_id);
 (   DROP INDEX public.idx_4369f002dd25ed3b;
       public            postgres    false    210            �           1259    58633    idx_4369f002f625d1ba    INDEX     T   CREATE INDEX idx_4369f002f625d1ba ON public.plan_trabajo USING btree (proyecto_id);
 (   DROP INDEX public.idx_4369f002f625d1ba;
       public            postgres    false    210            �           1259    58607    idx_48b38885dd25ed3b    INDEX     \   CREATE INDEX idx_48b38885dd25ed3b ON public.rendicion_cuentas USING btree (tipo_accion_id);
 (   DROP INDEX public.idx_48b38885dd25ed3b;
       public            postgres    false    206            �           1259    58606    idx_48b38885f625d1ba    INDEX     Y   CREATE INDEX idx_48b38885f625d1ba ON public.rendicion_cuentas USING btree (proyecto_id);
 (   DROP INDEX public.idx_48b38885f625d1ba;
       public            postgres    false    206            �           1259    58624    idx_6fd202b941cdebb0    INDEX     O   CREATE INDEX idx_6fd202b941cdebb0 ON public.proyecto USING btree (plantel_id);
 (   DROP INDEX public.idx_6fd202b941cdebb0;
       public            postgres    false    209            �           1259    58555    idx_7eef6ca4373c6c4a    INDEX     W   CREATE INDEX idx_7eef6ca4373c6c4a ON public.plantel USING btree (tipoasentamiento_id);
 (   DROP INDEX public.idx_7eef6ca4373c6c4a;
       public            postgres    false    200            �           1259    58575    idx_dfbfa0301877de2e    INDEX     c   CREATE INDEX idx_dfbfa0301877de2e ON public.diagnostico_plantel USING btree (idcondicionpatio_id);
 (   DROP INDEX public.idx_dfbfa0301877de2e;
       public            postgres    false    202            �           1259    58579    idx_dfbfa0302ac83a8a    INDEX     e   CREATE INDEX idx_dfbfa0302ac83a8a ON public.diagnostico_plantel USING btree (idcondiciondrenaje_id);
 (   DROP INDEX public.idx_dfbfa0302ac83a8a;
       public            postgres    false    202            �           1259    58580    idx_dfbfa030311b18f1    INDEX     e   CREATE INDEX idx_dfbfa030311b18f1 ON public.diagnostico_plantel USING btree (idcondicionenergia_id);
 (   DROP INDEX public.idx_dfbfa030311b18f1;
       public            postgres    false    202            �           1259    58569    idx_dfbfa03041cdebb0    INDEX     Z   CREATE INDEX idx_dfbfa03041cdebb0 ON public.diagnostico_plantel USING btree (plantel_id);
 (   DROP INDEX public.idx_dfbfa03041cdebb0;
       public            postgres    false    202            �           1259    58573    idx_dfbfa0305128e947    INDEX     k   CREATE INDEX idx_dfbfa0305128e947 ON public.diagnostico_plantel USING btree (idcondicionesbliblioteca_id);
 (   DROP INDEX public.idx_dfbfa0305128e947;
       public            postgres    false    202            �           1259    58571    idx_dfbfa030612be04d    INDEX     j   CREATE INDEX idx_dfbfa030612be04d ON public.diagnostico_plantel USING btree (idcondicionessanitarios_id);
 (   DROP INDEX public.idx_dfbfa030612be04d;
       public            postgres    false    202            �           1259    58572    idx_dfbfa03083cd1575    INDEX     e   CREATE INDEX idx_dfbfa03083cd1575 ON public.diagnostico_plantel USING btree (idcondicionoficina_id);
 (   DROP INDEX public.idx_dfbfa03083cd1575;
       public            postgres    false    202            �           1259    58581    idx_dfbfa030880e9d7d    INDEX     f   CREATE INDEX idx_dfbfa030880e9d7d ON public.diagnostico_plantel USING btree (idcondiciontelefono_id);
 (   DROP INDEX public.idx_dfbfa030880e9d7d;
       public            postgres    false    202            �           1259    58570    idx_dfbfa030a85158d1    INDEX     e   CREATE INDEX idx_dfbfa030a85158d1 ON public.diagnostico_plantel USING btree (idcondiciones_aula_id);
 (   DROP INDEX public.idx_dfbfa030a85158d1;
       public            postgres    false    202            �           1259    58582    idx_dfbfa030aa9185d8    INDEX     f   CREATE INDEX idx_dfbfa030aa9185d8 ON public.diagnostico_plantel USING btree (idcondicioninternet_id);
 (   DROP INDEX public.idx_dfbfa030aa9185d8;
       public            postgres    false    202            �           1259    58574    idx_dfbfa030d0ca6419    INDEX     h   CREATE INDEX idx_dfbfa030d0ca6419 ON public.diagnostico_plantel USING btree (idcondicionaulamedios_id);
 (   DROP INDEX public.idx_dfbfa030d0ca6419;
       public            postgres    false    202            �           1259    58576    idx_dfbfa030e241bcd3    INDEX     o   CREATE INDEX idx_dfbfa030e241bcd3 ON public.diagnostico_plantel USING btree (idcondicioncanchasdeportivas_id);
 (   DROP INDEX public.idx_dfbfa030e241bcd3;
       public            postgres    false    202            �           1259    58577    idx_dfbfa030e8ffb8e7    INDEX     c   CREATE INDEX idx_dfbfa030e8ffb8e7 ON public.diagnostico_plantel USING btree (idcondicionbarda_id);
 (   DROP INDEX public.idx_dfbfa030e8ffb8e7;
       public            postgres    false    202            �           1259    58578    idx_dfbfa030f31154f5    INDEX     b   CREATE INDEX idx_dfbfa030f31154f5 ON public.diagnostico_plantel USING btree (idcondicionagua_id);
 (   DROP INDEX public.idx_dfbfa030f31154f5;
       public            postgres    false    202            �           1259    58588    idx_f3e428077a94ba1a    INDEX     f   CREATE INDEX idx_f3e428077a94ba1a ON public.condicion_educativa_alumnos USING btree (diagnostico_id);
 (   DROP INDEX public.idx_f3e428077a94ba1a;
       public            postgres    false    203            �           1259    58589    idx_f3e4280791a441cc    INDEX     `   CREATE INDEX idx_f3e4280791a441cc ON public.condicion_educativa_alumnos USING btree (grado_id);
 (   DROP INDEX public.idx_f3e4280791a441cc;
       public            postgres    false    203            �           1259    58590    idx_f3e42807e33f8867    INDEX     b   CREATE INDEX idx_f3e42807e33f8867 ON public.condicion_educativa_alumnos USING btree (escuela_id);
 (   DROP INDEX public.idx_f3e42807e33f8867;
       public            postgres    false    203            �           1259    58532    idx_f6c6e2ce41cdebb0    INDEX     N   CREATE INDEX idx_f6c6e2ce41cdebb0 ON public.escuela USING btree (plantel_id);
 (   DROP INDEX public.idx_f6c6e2ce41cdebb0;
       public            postgres    false    197            �           2606    58703 "   control_gastos fk_141b8c4ca9b5e49a    FK CONSTRAINT     �   ALTER TABLE ONLY public.control_gastos
    ADD CONSTRAINT fk_141b8c4ca9b5e49a FOREIGN KEY (tipo_comprobante_id) REFERENCES public.tipo_comprobante(id);
 L   ALTER TABLE ONLY public.control_gastos DROP CONSTRAINT fk_141b8c4ca9b5e49a;
       public          postgres    false    2966    196    199            �           2606    58698 "   control_gastos fk_141b8c4cf625d1ba    FK CONSTRAINT     �   ALTER TABLE ONLY public.control_gastos
    ADD CONSTRAINT fk_141b8c4cf625d1ba FOREIGN KEY (proyecto_id) REFERENCES public.proyecto(id);
 L   ALTER TABLE ONLY public.control_gastos DROP CONSTRAINT fk_141b8c4cf625d1ba;
       public          postgres    false    209    199    3019            �           2606    58693 )   escuela_tipo_ensenanza fk_17fbbcc02f92be1    FK CONSTRAINT     �   ALTER TABLE ONLY public.escuela_tipo_ensenanza
    ADD CONSTRAINT fk_17fbbcc02f92be1 FOREIGN KEY (tipo_ensenanza_id) REFERENCES public.tipo_ensenanza(id) ON DELETE CASCADE;
 S   ALTER TABLE ONLY public.escuela_tipo_ensenanza DROP CONSTRAINT fk_17fbbcc02f92be1;
       public          postgres    false    3005    204    198            �           2606    58688 *   escuela_tipo_ensenanza fk_17fbbcc0e33f8867    FK CONSTRAINT     �   ALTER TABLE ONLY public.escuela_tipo_ensenanza
    ADD CONSTRAINT fk_17fbbcc0e33f8867 FOREIGN KEY (escuela_id) REFERENCES public.escuela(id) ON DELETE CASCADE;
 T   ALTER TABLE ONLY public.escuela_tipo_ensenanza DROP CONSTRAINT fk_17fbbcc0e33f8867;
       public          postgres    false    198    2968    197            �           2606    58828 /   condicion_docente_educativa fk_1cea54b77a94ba1a    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT fk_1cea54b77a94ba1a FOREIGN KEY (diagnostico_id) REFERENCES public.diagnostico_plantel(id);
 Y   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT fk_1cea54b77a94ba1a;
       public          postgres    false    212    202    2984            �           2606    58833 /   condicion_docente_educativa fk_1cea54b791a441cc    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT fk_1cea54b791a441cc FOREIGN KEY (grado_id) REFERENCES public.grado_ensenanza(id);
 Y   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT fk_1cea54b791a441cc;
       public          postgres    false    208    3015    212            �           2606    58838 /   condicion_docente_educativa fk_1cea54b7e33f8867    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT fk_1cea54b7e33f8867 FOREIGN KEY (escuela_id) REFERENCES public.escuela(id);
 Y   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT fk_1cea54b7e33f8867;
       public          postgres    false    197    212    2968            �           2606    58808 #   grado_ensenanza fk_2877888eda33e9e7    FK CONSTRAINT     �   ALTER TABLE ONLY public.grado_ensenanza
    ADD CONSTRAINT fk_2877888eda33e9e7 FOREIGN KEY (tipoensenanza_id) REFERENCES public.tipo_ensenanza(id);
 M   ALTER TABLE ONLY public.grado_ensenanza DROP CONSTRAINT fk_2877888eda33e9e7;
       public          postgres    false    3005    204    208            �           2606    58823     plan_trabajo fk_4369f002dd25ed3b    FK CONSTRAINT     �   ALTER TABLE ONLY public.plan_trabajo
    ADD CONSTRAINT fk_4369f002dd25ed3b FOREIGN KEY (tipo_accion_id) REFERENCES public.tipo_accion(id);
 J   ALTER TABLE ONLY public.plan_trabajo DROP CONSTRAINT fk_4369f002dd25ed3b;
       public          postgres    false    3025    210    211            �           2606    58818     plan_trabajo fk_4369f002f625d1ba    FK CONSTRAINT     �   ALTER TABLE ONLY public.plan_trabajo
    ADD CONSTRAINT fk_4369f002f625d1ba FOREIGN KEY (proyecto_id) REFERENCES public.proyecto(id);
 J   ALTER TABLE ONLY public.plan_trabajo DROP CONSTRAINT fk_4369f002f625d1ba;
       public          postgres    false    3019    209    210            �           2606    58803 %   rendicion_cuentas fk_48b38885dd25ed3b    FK CONSTRAINT     �   ALTER TABLE ONLY public.rendicion_cuentas
    ADD CONSTRAINT fk_48b38885dd25ed3b FOREIGN KEY (tipo_accion_id) REFERENCES public.tipo_accion(id);
 O   ALTER TABLE ONLY public.rendicion_cuentas DROP CONSTRAINT fk_48b38885dd25ed3b;
       public          postgres    false    3025    206    211            �           2606    58798 %   rendicion_cuentas fk_48b38885f625d1ba    FK CONSTRAINT     �   ALTER TABLE ONLY public.rendicion_cuentas
    ADD CONSTRAINT fk_48b38885f625d1ba FOREIGN KEY (proyecto_id) REFERENCES public.proyecto(id);
 O   ALTER TABLE ONLY public.rendicion_cuentas DROP CONSTRAINT fk_48b38885f625d1ba;
       public          postgres    false    206    3019    209            �           2606    58813    proyecto fk_6fd202b941cdebb0    FK CONSTRAINT     �   ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT fk_6fd202b941cdebb0 FOREIGN KEY (plantel_id) REFERENCES public.plantel(id);
 F   ALTER TABLE ONLY public.proyecto DROP CONSTRAINT fk_6fd202b941cdebb0;
       public          postgres    false    209    200    2980            �           2606    58708    plantel fk_7eef6ca4373c6c4a    FK CONSTRAINT     �   ALTER TABLE ONLY public.plantel
    ADD CONSTRAINT fk_7eef6ca4373c6c4a FOREIGN KEY (tipoasentamiento_id) REFERENCES public.tipo_asentamiento(id);
 E   ALTER TABLE ONLY public.plantel DROP CONSTRAINT fk_7eef6ca4373c6c4a;
       public          postgres    false    205    200    3007            �           2606    58743 '   diagnostico_plantel fk_dfbfa0301877de2e    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa0301877de2e FOREIGN KEY (idcondicionpatio_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa0301877de2e;
       public          postgres    false    207    3013    202            �           2606    58763 '   diagnostico_plantel fk_dfbfa0302ac83a8a    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa0302ac83a8a FOREIGN KEY (idcondiciondrenaje_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa0302ac83a8a;
       public          postgres    false    3013    207    202            �           2606    58768 '   diagnostico_plantel fk_dfbfa030311b18f1    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030311b18f1 FOREIGN KEY (idcondicionenergia_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030311b18f1;
       public          postgres    false    202    3013    207            �           2606    58713 '   diagnostico_plantel fk_dfbfa03041cdebb0    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa03041cdebb0 FOREIGN KEY (plantel_id) REFERENCES public.plantel(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa03041cdebb0;
       public          postgres    false    2980    202    200            �           2606    58733 '   diagnostico_plantel fk_dfbfa0305128e947    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa0305128e947 FOREIGN KEY (idcondicionesbliblioteca_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa0305128e947;
       public          postgres    false    3013    207    202            �           2606    58723 '   diagnostico_plantel fk_dfbfa030612be04d    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030612be04d FOREIGN KEY (idcondicionessanitarios_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030612be04d;
       public          postgres    false    3013    202    207            �           2606    58728 '   diagnostico_plantel fk_dfbfa03083cd1575    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa03083cd1575 FOREIGN KEY (idcondicionoficina_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa03083cd1575;
       public          postgres    false    207    202    3013            �           2606    58773 '   diagnostico_plantel fk_dfbfa030880e9d7d    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030880e9d7d FOREIGN KEY (idcondiciontelefono_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030880e9d7d;
       public          postgres    false    207    202    3013            �           2606    58718 '   diagnostico_plantel fk_dfbfa030a85158d1    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030a85158d1 FOREIGN KEY (idcondiciones_aula_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030a85158d1;
       public          postgres    false    202    207    3013            �           2606    58778 '   diagnostico_plantel fk_dfbfa030aa9185d8    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030aa9185d8 FOREIGN KEY (idcondicioninternet_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030aa9185d8;
       public          postgres    false    207    3013    202            �           2606    58738 '   diagnostico_plantel fk_dfbfa030d0ca6419    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030d0ca6419 FOREIGN KEY (idcondicionaulamedios_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030d0ca6419;
       public          postgres    false    207    3013    202            �           2606    58748 '   diagnostico_plantel fk_dfbfa030e241bcd3    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030e241bcd3 FOREIGN KEY (idcondicioncanchasdeportivas_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030e241bcd3;
       public          postgres    false    202    207    3013            �           2606    58753 '   diagnostico_plantel fk_dfbfa030e8ffb8e7    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030e8ffb8e7 FOREIGN KEY (idcondicionbarda_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030e8ffb8e7;
       public          postgres    false    3013    202    207            �           2606    58758 '   diagnostico_plantel fk_dfbfa030f31154f5    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030f31154f5 FOREIGN KEY (idcondicionagua_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030f31154f5;
       public          postgres    false    202    3013    207            �           2606    58783 /   condicion_educativa_alumnos fk_f3e428077a94ba1a    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT fk_f3e428077a94ba1a FOREIGN KEY (diagnostico_id) REFERENCES public.diagnostico_plantel(id);
 Y   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT fk_f3e428077a94ba1a;
       public          postgres    false    203    202    2984            �           2606    58788 /   condicion_educativa_alumnos fk_f3e4280791a441cc    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT fk_f3e4280791a441cc FOREIGN KEY (grado_id) REFERENCES public.grado_ensenanza(id);
 Y   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT fk_f3e4280791a441cc;
       public          postgres    false    208    3015    203            �           2606    58793 /   condicion_educativa_alumnos fk_f3e42807e33f8867    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT fk_f3e42807e33f8867 FOREIGN KEY (escuela_id) REFERENCES public.escuela(id);
 Y   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT fk_f3e42807e33f8867;
       public          postgres    false    2968    203    197            �           2606    58683    escuela fk_f6c6e2ce41cdebb0    FK CONSTRAINT        ALTER TABLE ONLY public.escuela
    ADD CONSTRAINT fk_f6c6e2ce41cdebb0 FOREIGN KEY (plantel_id) REFERENCES public.plantel(id);
 E   ALTER TABLE ONLY public.escuela DROP CONSTRAINT fk_f6c6e2ce41cdebb0;
       public          postgres    false    2980    197    200            �      x������ � �      �      x������ � �      }      x������ � �      �      x������ � �      {      x������ � �      |      x������ � �         4   x�3���v
qt��4�2�tt	u����8]}<}=�@<�=... (
�      �   I   x���	�0��m1�&w���#�� ����ϐ�v�9��}�#XU]U0���l*�ni���j�� ��1�      �      x������ � �      ~      x������ � �      �      x������ � �      �      x������ � �      �   t  x��T�n�0���h�Mv7H�m�v�r"��(Gҍ�6;d(�~�~����V4Z,����wzӬ���؞��c�<eK��کĲ���Ԭ�����2�|쬳$6��k��8��H���NXbj;8਋B9�D�t�}�d���L�㌷������xkSFc�{����c�:��pi/q�:��G�T�@ik�Ӎě"֐�f/�W~�~�
x��S�a���l��%������&{RE��t��U(?�ʬ�Y��=	���@�J
=(PZmVƚ���VF��)�mT�zH)�z� ;5T���Ѡ�eC*>V�'������L�Jq��������������]7o�ju��s�����B�`G)��3?PMq�Ds��Ԇˀb.\��u]6���9C��k��>(�;_%�g�ڦ2�1��?�^5���5�#��j�{߳x�~YTlF����Y�l)ކ	��2�1c�)�Pf�2d�<K�NU�inOU�]U����H����Z}�2���ȇ�?�w����m����i�9$���w$��U��4ra�3�Ǥ�*��"�����뚮���͛1.�b����cW&
u�0��
�v(v����ջ��Q]J�3m��7!�z      �      x������ � �      z   �   x���1�0E��>@����B��M2j�H=G�b$aA������?g��vh��Q��qba�χ���e�$0���G�	���mO��h����w~'�q<����b�'Ѫ��jQ�uS4j�����p��~�@��^�b�?�l�?��׻\����k����L�gTG��4\��9}�l6K�����}�EQ� +�tz      �   &   x�3�t*M���2��M���2�JM/�I,����� ��      �   *   x�3����KI-�2�(��M,�L�2�NM.�Ksb���� �2     