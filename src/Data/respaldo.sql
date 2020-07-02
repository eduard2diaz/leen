PGDMP     :    !                 x        
   leen_last2 "   10.13 (Ubuntu 10.13-1.pgdg18.04+1)     12.3 (Ubuntu 12.3-1.pgdg18.04+1) �    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    59203 
   leen_last2    DATABASE     |   CREATE DATABASE leen_last2 WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_MX.UTF-8' LC_CTYPE = 'es_MX.UTF-8';
    DROP DATABASE leen_last2;
                postgres    false                        3079    59557    dblink 	   EXTENSION     :   CREATE EXTENSION IF NOT EXISTS dblink WITH SCHEMA public;
    DROP EXTENSION dblink;
                   false            �           0    0    EXTENSION dblink    COMMENT     _   COMMENT ON EXTENSION dblink IS 'connect to other PostgreSQL databases from within a database';
                        false    2            �            1259    59316    condicion_docente_educativa    TABLE       CREATE TABLE public.condicion_docente_educativa (
    id integer NOT NULL,
    diagnostico_id integer NOT NULL,
    grado_id integer NOT NULL,
    escuela_id integer NOT NULL,
    curp character varying(18) NOT NULL,
    nombre character varying(50) NOT NULL
);
 /   DROP TABLE public.condicion_docente_educativa;
       public            postgres    false            �            1259    59350 "   condicion_docente_educativa_id_seq    SEQUENCE     �   CREATE SEQUENCE public.condicion_docente_educativa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.condicion_docente_educativa_id_seq;
       public          postgres    false            �            1259    59267    condicion_educativa_alumnos    TABLE     �   CREATE TABLE public.condicion_educativa_alumnos (
    id integer NOT NULL,
    diagnostico_id integer NOT NULL,
    grado_id integer NOT NULL,
    escuela_id integer NOT NULL,
    numalumnas integer NOT NULL,
    numalumnos integer NOT NULL
);
 /   DROP TABLE public.condicion_educativa_alumnos;
       public            postgres    false            �            1259    59336 "   condicion_educativa_alumnos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.condicion_educativa_alumnos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.condicion_educativa_alumnos_id_seq;
       public          postgres    false            �            1259    59225    control_gastos    TABLE     M  CREATE TABLE public.control_gastos (
    id integer NOT NULL,
    plantrabajo_id integer NOT NULL,
    tipo_comprobante_id integer NOT NULL,
    fechacaptura date NOT NULL,
    concepto text NOT NULL,
    numerocomprobante integer NOT NULL,
    monto double precision NOT NULL,
    controlarchivos character varying(255) NOT NULL
);
 "   DROP TABLE public.control_gastos;
       public            postgres    false            �            1259    59328    control_gastos_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.control_gastos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.control_gastos_id_seq;
       public          postgres    false            �            1259    59245    diagnostico_plantel    TABLE     �  CREATE TABLE public.diagnostico_plantel (
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
       public            postgres    false            �            1259    59334    diagnostico_plantel_id_seq    SEQUENCE     �   CREATE SEQUENCE public.diagnostico_plantel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.diagnostico_plantel_id_seq;
       public          postgres    false            �            1259    59212    escuela    TABLE     �   CREATE TABLE public.escuela (
    id integer NOT NULL,
    plantel_id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    ccts character varying(10) NOT NULL
);
    DROP TABLE public.escuela;
       public            postgres    false            �            1259    59326    escuela_id_seq    SEQUENCE     w   CREATE SEQUENCE public.escuela_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.escuela_id_seq;
       public          postgres    false            �            1259    59218    escuela_tipo_ensenanza    TABLE     x   CREATE TABLE public.escuela_tipo_ensenanza (
    escuela_id integer NOT NULL,
    tipo_ensenanza_id integer NOT NULL
);
 *   DROP TABLE public.escuela_tipo_ensenanza;
       public            postgres    false            �            1259    59298    plan_trabajo    TABLE     �  CREATE TABLE public.plan_trabajo (
    id integer NOT NULL,
    plantel_id integer NOT NULL,
    tipo_accion_id integer NOT NULL,
    fechainicio date NOT NULL,
    fechafin date,
    montoasignado double precision NOT NULL,
    numero character varying(10) NOT NULL,
    descripcionaccion text NOT NULL,
    tiempoestimado character varying(50) NOT NULL,
    costoestimado double precision NOT NULL,
    planarchivo character varying(255) NOT NULL
);
     DROP TABLE public.plan_trabajo;
       public            postgres    false            �            1259    59235    plantel    TABLE     e   CREATE TABLE public.plantel (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL
);
    DROP TABLE public.plantel;
       public            postgres    false            �            1259    59553    escuelas_con_proyecto_view    VIEW       CREATE VIEW public.escuelas_con_proyecto_view AS
 SELECT DISTINCT e.id,
    e.nombre,
    e.ccts,
    p.nombre AS plantel
   FROM ((public.escuela e
     JOIN public.plantel p ON ((p.id = e.plantel_id)))
     JOIN public.plan_trabajo ON ((plan_trabajo.plantel_id = p.id)));
 -   DROP VIEW public.escuelas_con_proyecto_view;
       public          postgres    false    201    209    201    198    198    198    198            �            1259    59240    estatus    TABLE     �   CREATE TABLE public.estatus (
    id integer NOT NULL,
    estatus character varying(250) NOT NULL,
    code integer NOT NULL
);
    DROP TABLE public.estatus;
       public            postgres    false            �            1259    59332    estatus_id_seq    SEQUENCE     w   CREATE SEQUENCE public.estatus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.estatus_id_seq;
       public          postgres    false            �            1259    59292    grado_ensenanza    TABLE     �   CREATE TABLE public.grado_ensenanza (
    id integer NOT NULL,
    tipoensenanza_id integer NOT NULL,
    nombre character varying(30) NOT NULL
);
 #   DROP TABLE public.grado_ensenanza;
       public            postgres    false            �            1259    59344    grado_ensenanza_id_seq    SEQUENCE        CREATE SEQUENCE public.grado_ensenanza_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.grado_ensenanza_id_seq;
       public          postgres    false            �            1259    59346    plan_trabajo_id_seq    SEQUENCE     |   CREATE SEQUENCE public.plan_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.plan_trabajo_id_seq;
       public          postgres    false            �            1259    59330    plantel_id_seq    SEQUENCE     w   CREATE SEQUENCE public.plantel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.plantel_id_seq;
       public          postgres    false            �            1259    59545    planteles_con_proyecto_view    VIEW     �   CREATE VIEW public.planteles_con_proyecto_view AS
 SELECT DISTINCT p.id,
    p.nombre
   FROM (public.plantel p
     JOIN public.plan_trabajo ON ((plan_trabajo.plantel_id = p.id)));
 .   DROP VIEW public.planteles_con_proyecto_view;
       public          postgres    false    209    201    201            �            1259    59536    planteles_sin_aguapotable_view    VIEW     �  CREATE VIEW public.planteles_sin_aguapotable_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.aguapotable = false));
 1   DROP VIEW public.planteles_sin_aguapotable_view;
       public          postgres    false    201    203    203    203    201            �            1259    59531    planteles_sin_bibliotecas_view    VIEW     �  CREATE VIEW public.planteles_sin_bibliotecas_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.numerobibliotecas = 0));
 1   DROP VIEW public.planteles_sin_bibliotecas_view;
       public          postgres    false    203    203    203    201    201            �            1259    59526    planteles_sin_drenaje_view    VIEW     �  CREATE VIEW public.planteles_sin_drenaje_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.drenaje = false));
 -   DROP VIEW public.planteles_sin_drenaje_view;
       public          postgres    false    203    201    203    201    203            �            1259    59521    planteles_sin_electricidad_view    VIEW     �  CREATE VIEW public.planteles_sin_electricidad_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.energiaelectrica = false));
 2   DROP VIEW public.planteles_sin_electricidad_view;
       public          postgres    false    203    201    201    203    203            �            1259    59516    planteles_sin_internet_view    VIEW     �  CREATE VIEW public.planteles_sin_internet_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.internet = false));
 .   DROP VIEW public.planteles_sin_internet_view;
       public          postgres    false    201    203    203    203    201            �            1259    59511    planteles_sin_sanitarios_view    VIEW     �  CREATE VIEW public.planteles_sin_sanitarios_view AS
 SELECT p.id,
    p.nombre
   FROM (public.diagnostico_plantel d
     JOIN public.plantel p ON ((p.id = d.plantel_id)))
  WHERE ((d.fecha >= ALL ( SELECT d2.fecha
           FROM (public.diagnostico_plantel d2
             JOIN public.plantel p2 ON ((p2.id = d2.plantel_id)))
          WHERE (p2.id = p.id))) AND (d.numerosanitarios = 0));
 0   DROP VIEW public.planteles_sin_sanitarios_view;
       public          postgres    false    203    201    201    203    203            �            1259    59280    rendicion_cuentas    TABLE       CREATE TABLE public.rendicion_cuentas (
    id integer NOT NULL,
    plantrabajo_id integer NOT NULL,
    tipo_accion_id integer NOT NULL,
    fechacaptura date NOT NULL,
    monto double precision NOT NULL,
    rendicionesarchivos character varying(255) NOT NULL
);
 %   DROP TABLE public.rendicion_cuentas;
       public            postgres    false            �            1259    59340    rendicion_cuentas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rendicion_cuentas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.rendicion_cuentas_id_seq;
       public          postgres    false            �            1259    59308    tipo_accion    TABLE     �   CREATE TABLE public.tipo_accion (
    id integer NOT NULL,
    accion character varying(200) NOT NULL,
    descripcion text NOT NULL,
    fechacaptura date NOT NULL
);
    DROP TABLE public.tipo_accion;
       public            postgres    false            �            1259    59348    tipo_accion_id_seq    SEQUENCE     {   CREATE SEQUENCE public.tipo_accion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tipo_accion_id_seq;
       public          postgres    false            �            1259    59204    tipo_comprobante    TABLE     �   CREATE TABLE public.tipo_comprobante (
    id integer NOT NULL,
    comprobante character varying(50) NOT NULL,
    descripcion text NOT NULL,
    fechacaptura date NOT NULL
);
 $   DROP TABLE public.tipo_comprobante;
       public            postgres    false            �            1259    59324    tipo_comprobante_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_comprobante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tipo_comprobante_id_seq;
       public          postgres    false            �            1259    59287    tipo_condicion    TABLE     n   CREATE TABLE public.tipo_condicion (
    id integer NOT NULL,
    condicion character varying(50) NOT NULL
);
 "   DROP TABLE public.tipo_condicion;
       public            postgres    false            �            1259    59342    tipo_condicion_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.tipo_condicion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tipo_condicion_id_seq;
       public          postgres    false            �            1259    59275    tipo_ensenanza    TABLE     k   CREATE TABLE public.tipo_ensenanza (
    id integer NOT NULL,
    nombre character varying(40) NOT NULL
);
 "   DROP TABLE public.tipo_ensenanza;
       public            postgres    false            �            1259    59338    tipo_ensenanza_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.tipo_ensenanza_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tipo_ensenanza_id_seq;
       public          postgres    false            �            1259    59507    total_escuelas_view    VIEW     a   CREATE VIEW public.total_escuelas_view AS
 SELECT count(e.id) AS count
   FROM public.escuela e;
 &   DROP VIEW public.total_escuelas_view;
       public          postgres    false    198            �            1259    59503    total_planteles_view    VIEW     b   CREATE VIEW public.total_planteles_view AS
 SELECT count(e.id) AS count
   FROM public.plantel e;
 '   DROP VIEW public.total_planteles_view;
       public          postgres    false    201            �          0    59316    condicion_docente_educativa 
   TABLE DATA           m   COPY public.condicion_docente_educativa (id, diagnostico_id, grado_id, escuela_id, curp, nombre) FROM stdin;
    public          postgres    false    211   F�       �          0    59267    condicion_educativa_alumnos 
   TABLE DATA           w   COPY public.condicion_educativa_alumnos (id, diagnostico_id, grado_id, escuela_id, numalumnas, numalumnos) FROM stdin;
    public          postgres    false    204   �       �          0    59225    control_gastos 
   TABLE DATA           �   COPY public.control_gastos (id, plantrabajo_id, tipo_comprobante_id, fechacaptura, concepto, numerocomprobante, monto, controlarchivos) FROM stdin;
    public          postgres    false    200   ��       �          0    59245    diagnostico_plantel 
   TABLE DATA           �  COPY public.diagnostico_plantel (id, plantel_id, idcondiciones_aula_id, idcondicionessanitarios_id, idcondicionoficina_id, idcondicionesbliblioteca_id, idcondicionaulamedios_id, idcondicionpatio_id, idcondicioncanchasdeportivas_id, idcondicionbarda_id, idcondicionagua_id, idcondiciondrenaje_id, idcondicionenergia_id, idcondiciontelefono_id, idcondicioninternet_id, numeroaulas, numerosanitarios, numerooficinas, numerobibliotecas, numeroaulasmedios, numeropatio, numerocanchasdeportivas, numerobarda, aguapotable, drenaje, energiaelectrica, telefono, internet, iddiagnosticoplantel, diagnosticoarchivo, fecha, descrip_num_aulas, descrip_num_sanitarios, descrip_num_oficinas, descrip_num_bibliotecas, descrip_num_aulamedios, descrip_num_patios, descrip_num_canchas_deportivas, descrip_num_bardas, descrip_agua_potables, descrip_drenaje, descrip_energiaelectrica, descrip_telefonia, descrip_internet) FROM stdin;
    public          postgres    false    203   �       �          0    59212    escuela 
   TABLE DATA           ?   COPY public.escuela (id, plantel_id, nombre, ccts) FROM stdin;
    public          postgres    false    198   ��       �          0    59218    escuela_tipo_ensenanza 
   TABLE DATA           O   COPY public.escuela_tipo_ensenanza (escuela_id, tipo_ensenanza_id) FROM stdin;
    public          postgres    false    199   ��       �          0    59240    estatus 
   TABLE DATA           4   COPY public.estatus (id, estatus, code) FROM stdin;
    public          postgres    false    202   ��       �          0    59292    grado_ensenanza 
   TABLE DATA           G   COPY public.grado_ensenanza (id, tipoensenanza_id, nombre) FROM stdin;
    public          postgres    false    208   -�       �          0    59298    plan_trabajo 
   TABLE DATA           �   COPY public.plan_trabajo (id, plantel_id, tipo_accion_id, fechainicio, fechafin, montoasignado, numero, descripcionaccion, tiempoestimado, costoestimado, planarchivo) FROM stdin;
    public          postgres    false    209   ��       �          0    59235    plantel 
   TABLE DATA           -   COPY public.plantel (id, nombre) FROM stdin;
    public          postgres    false    201   +�       �          0    59280    rendicion_cuentas 
   TABLE DATA           y   COPY public.rendicion_cuentas (id, plantrabajo_id, tipo_accion_id, fechacaptura, monto, rendicionesarchivos) FROM stdin;
    public          postgres    false    206   P�       �          0    59308    tipo_accion 
   TABLE DATA           L   COPY public.tipo_accion (id, accion, descripcion, fechacaptura) FROM stdin;
    public          postgres    false    210   ��       �          0    59204    tipo_comprobante 
   TABLE DATA           V   COPY public.tipo_comprobante (id, comprobante, descripcion, fechacaptura) FROM stdin;
    public          postgres    false    197   <�       �          0    59287    tipo_condicion 
   TABLE DATA           7   COPY public.tipo_condicion (id, condicion) FROM stdin;
    public          postgres    false    207   �       �          0    59275    tipo_ensenanza 
   TABLE DATA           4   COPY public.tipo_ensenanza (id, nombre) FROM stdin;
    public          postgres    false    205   H�       �           0    0 "   condicion_docente_educativa_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.condicion_docente_educativa_id_seq', 3, true);
          public          postgres    false    225            �           0    0 "   condicion_educativa_alumnos_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.condicion_educativa_alumnos_id_seq', 2, true);
          public          postgres    false    218            �           0    0    control_gastos_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.control_gastos_id_seq', 2, true);
          public          postgres    false    214            �           0    0    diagnostico_plantel_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.diagnostico_plantel_id_seq', 1, true);
          public          postgres    false    217            �           0    0    escuela_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.escuela_id_seq', 2, true);
          public          postgres    false    213            �           0    0    estatus_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.estatus_id_seq', 3, true);
          public          postgres    false    216            �           0    0    grado_ensenanza_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.grado_ensenanza_id_seq', 10, true);
          public          postgres    false    222            �           0    0    plan_trabajo_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.plan_trabajo_id_seq', 11, true);
          public          postgres    false    223            �           0    0    plantel_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.plantel_id_seq', 1, true);
          public          postgres    false    215            �           0    0    rendicion_cuentas_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.rendicion_cuentas_id_seq', 2, true);
          public          postgres    false    220            �           0    0    tipo_accion_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.tipo_accion_id_seq', 3, true);
          public          postgres    false    224            �           0    0    tipo_comprobante_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.tipo_comprobante_id_seq', 3, true);
          public          postgres    false    212            �           0    0    tipo_condicion_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tipo_condicion_id_seq', 3, true);
          public          postgres    false    221            �           0    0    tipo_ensenanza_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tipo_ensenanza_id_seq', 3, true);
          public          postgres    false    219            �           2606    59320 <   condicion_docente_educativa condicion_docente_educativa_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT condicion_docente_educativa_pkey PRIMARY KEY (id);
 f   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT condicion_docente_educativa_pkey;
       public            postgres    false    211            �           2606    59271 <   condicion_educativa_alumnos condicion_educativa_alumnos_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT condicion_educativa_alumnos_pkey PRIMARY KEY (id);
 f   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT condicion_educativa_alumnos_pkey;
       public            postgres    false    204            �           2606    59232 "   control_gastos control_gastos_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.control_gastos
    ADD CONSTRAINT control_gastos_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.control_gastos DROP CONSTRAINT control_gastos_pkey;
       public            postgres    false    200            �           2606    59252 ,   diagnostico_plantel diagnostico_plantel_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT diagnostico_plantel_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT diagnostico_plantel_pkey;
       public            postgres    false    203            �           2606    59216    escuela escuela_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.escuela
    ADD CONSTRAINT escuela_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.escuela DROP CONSTRAINT escuela_pkey;
       public            postgres    false    198            �           2606    59222 2   escuela_tipo_ensenanza escuela_tipo_ensenanza_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.escuela_tipo_ensenanza
    ADD CONSTRAINT escuela_tipo_ensenanza_pkey PRIMARY KEY (escuela_id, tipo_ensenanza_id);
 \   ALTER TABLE ONLY public.escuela_tipo_ensenanza DROP CONSTRAINT escuela_tipo_ensenanza_pkey;
       public            postgres    false    199    199            �           2606    59244    estatus estatus_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.estatus
    ADD CONSTRAINT estatus_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.estatus DROP CONSTRAINT estatus_pkey;
       public            postgres    false    202            �           2606    59296 $   grado_ensenanza grado_ensenanza_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.grado_ensenanza
    ADD CONSTRAINT grado_ensenanza_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.grado_ensenanza DROP CONSTRAINT grado_ensenanza_pkey;
       public            postgres    false    208            �           2606    59305    plan_trabajo plan_trabajo_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.plan_trabajo
    ADD CONSTRAINT plan_trabajo_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.plan_trabajo DROP CONSTRAINT plan_trabajo_pkey;
       public            postgres    false    209            �           2606    59239    plantel plantel_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.plantel
    ADD CONSTRAINT plantel_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.plantel DROP CONSTRAINT plantel_pkey;
       public            postgres    false    201            �           2606    59284 (   rendicion_cuentas rendicion_cuentas_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.rendicion_cuentas
    ADD CONSTRAINT rendicion_cuentas_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.rendicion_cuentas DROP CONSTRAINT rendicion_cuentas_pkey;
       public            postgres    false    206            �           2606    59315    tipo_accion tipo_accion_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tipo_accion
    ADD CONSTRAINT tipo_accion_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.tipo_accion DROP CONSTRAINT tipo_accion_pkey;
       public            postgres    false    210            �           2606    59211 &   tipo_comprobante tipo_comprobante_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.tipo_comprobante
    ADD CONSTRAINT tipo_comprobante_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.tipo_comprobante DROP CONSTRAINT tipo_comprobante_pkey;
       public            postgres    false    197            �           2606    59291 "   tipo_condicion tipo_condicion_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tipo_condicion
    ADD CONSTRAINT tipo_condicion_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.tipo_condicion DROP CONSTRAINT tipo_condicion_pkey;
       public            postgres    false    207            �           2606    59279 "   tipo_ensenanza tipo_ensenanza_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tipo_ensenanza
    ADD CONSTRAINT tipo_ensenanza_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.tipo_ensenanza DROP CONSTRAINT tipo_ensenanza_pkey;
       public            postgres    false    205            �           1259    59234    idx_141b8c4ca9b5e49a    INDEX     ^   CREATE INDEX idx_141b8c4ca9b5e49a ON public.control_gastos USING btree (tipo_comprobante_id);
 (   DROP INDEX public.idx_141b8c4ca9b5e49a;
       public            postgres    false    200            �           1259    59233    idx_141b8c4cd5384f42    INDEX     Y   CREATE INDEX idx_141b8c4cd5384f42 ON public.control_gastos USING btree (plantrabajo_id);
 (   DROP INDEX public.idx_141b8c4cd5384f42;
       public            postgres    false    200            �           1259    59224    idx_17fbbcc02f92be1    INDEX     c   CREATE INDEX idx_17fbbcc02f92be1 ON public.escuela_tipo_ensenanza USING btree (tipo_ensenanza_id);
 '   DROP INDEX public.idx_17fbbcc02f92be1;
       public            postgres    false    199            �           1259    59223    idx_17fbbcc0e33f8867    INDEX     ]   CREATE INDEX idx_17fbbcc0e33f8867 ON public.escuela_tipo_ensenanza USING btree (escuela_id);
 (   DROP INDEX public.idx_17fbbcc0e33f8867;
       public            postgres    false    199            �           1259    59321    idx_1cea54b77a94ba1a    INDEX     f   CREATE INDEX idx_1cea54b77a94ba1a ON public.condicion_docente_educativa USING btree (diagnostico_id);
 (   DROP INDEX public.idx_1cea54b77a94ba1a;
       public            postgres    false    211            �           1259    59322    idx_1cea54b791a441cc    INDEX     `   CREATE INDEX idx_1cea54b791a441cc ON public.condicion_docente_educativa USING btree (grado_id);
 (   DROP INDEX public.idx_1cea54b791a441cc;
       public            postgres    false    211            �           1259    59323    idx_1cea54b7e33f8867    INDEX     b   CREATE INDEX idx_1cea54b7e33f8867 ON public.condicion_docente_educativa USING btree (escuela_id);
 (   DROP INDEX public.idx_1cea54b7e33f8867;
       public            postgres    false    211            �           1259    59297    idx_2877888eda33e9e7    INDEX     \   CREATE INDEX idx_2877888eda33e9e7 ON public.grado_ensenanza USING btree (tipoensenanza_id);
 (   DROP INDEX public.idx_2877888eda33e9e7;
       public            postgres    false    208            �           1259    59306    idx_4369f00241cdebb0    INDEX     S   CREATE INDEX idx_4369f00241cdebb0 ON public.plan_trabajo USING btree (plantel_id);
 (   DROP INDEX public.idx_4369f00241cdebb0;
       public            postgres    false    209            �           1259    59307    idx_4369f002dd25ed3b    INDEX     W   CREATE INDEX idx_4369f002dd25ed3b ON public.plan_trabajo USING btree (tipo_accion_id);
 (   DROP INDEX public.idx_4369f002dd25ed3b;
       public            postgres    false    209            �           1259    59285    idx_48b38885d5384f42    INDEX     \   CREATE INDEX idx_48b38885d5384f42 ON public.rendicion_cuentas USING btree (plantrabajo_id);
 (   DROP INDEX public.idx_48b38885d5384f42;
       public            postgres    false    206            �           1259    59286    idx_48b38885dd25ed3b    INDEX     \   CREATE INDEX idx_48b38885dd25ed3b ON public.rendicion_cuentas USING btree (tipo_accion_id);
 (   DROP INDEX public.idx_48b38885dd25ed3b;
       public            postgres    false    206            �           1259    59259    idx_dfbfa0301877de2e    INDEX     c   CREATE INDEX idx_dfbfa0301877de2e ON public.diagnostico_plantel USING btree (idcondicionpatio_id);
 (   DROP INDEX public.idx_dfbfa0301877de2e;
       public            postgres    false    203            �           1259    59263    idx_dfbfa0302ac83a8a    INDEX     e   CREATE INDEX idx_dfbfa0302ac83a8a ON public.diagnostico_plantel USING btree (idcondiciondrenaje_id);
 (   DROP INDEX public.idx_dfbfa0302ac83a8a;
       public            postgres    false    203            �           1259    59264    idx_dfbfa030311b18f1    INDEX     e   CREATE INDEX idx_dfbfa030311b18f1 ON public.diagnostico_plantel USING btree (idcondicionenergia_id);
 (   DROP INDEX public.idx_dfbfa030311b18f1;
       public            postgres    false    203            �           1259    59253    idx_dfbfa03041cdebb0    INDEX     Z   CREATE INDEX idx_dfbfa03041cdebb0 ON public.diagnostico_plantel USING btree (plantel_id);
 (   DROP INDEX public.idx_dfbfa03041cdebb0;
       public            postgres    false    203            �           1259    59257    idx_dfbfa0305128e947    INDEX     k   CREATE INDEX idx_dfbfa0305128e947 ON public.diagnostico_plantel USING btree (idcondicionesbliblioteca_id);
 (   DROP INDEX public.idx_dfbfa0305128e947;
       public            postgres    false    203            �           1259    59255    idx_dfbfa030612be04d    INDEX     j   CREATE INDEX idx_dfbfa030612be04d ON public.diagnostico_plantel USING btree (idcondicionessanitarios_id);
 (   DROP INDEX public.idx_dfbfa030612be04d;
       public            postgres    false    203            �           1259    59256    idx_dfbfa03083cd1575    INDEX     e   CREATE INDEX idx_dfbfa03083cd1575 ON public.diagnostico_plantel USING btree (idcondicionoficina_id);
 (   DROP INDEX public.idx_dfbfa03083cd1575;
       public            postgres    false    203            �           1259    59265    idx_dfbfa030880e9d7d    INDEX     f   CREATE INDEX idx_dfbfa030880e9d7d ON public.diagnostico_plantel USING btree (idcondiciontelefono_id);
 (   DROP INDEX public.idx_dfbfa030880e9d7d;
       public            postgres    false    203            �           1259    59254    idx_dfbfa030a85158d1    INDEX     e   CREATE INDEX idx_dfbfa030a85158d1 ON public.diagnostico_plantel USING btree (idcondiciones_aula_id);
 (   DROP INDEX public.idx_dfbfa030a85158d1;
       public            postgres    false    203            �           1259    59266    idx_dfbfa030aa9185d8    INDEX     f   CREATE INDEX idx_dfbfa030aa9185d8 ON public.diagnostico_plantel USING btree (idcondicioninternet_id);
 (   DROP INDEX public.idx_dfbfa030aa9185d8;
       public            postgres    false    203            �           1259    59258    idx_dfbfa030d0ca6419    INDEX     h   CREATE INDEX idx_dfbfa030d0ca6419 ON public.diagnostico_plantel USING btree (idcondicionaulamedios_id);
 (   DROP INDEX public.idx_dfbfa030d0ca6419;
       public            postgres    false    203            �           1259    59260    idx_dfbfa030e241bcd3    INDEX     o   CREATE INDEX idx_dfbfa030e241bcd3 ON public.diagnostico_plantel USING btree (idcondicioncanchasdeportivas_id);
 (   DROP INDEX public.idx_dfbfa030e241bcd3;
       public            postgres    false    203            �           1259    59261    idx_dfbfa030e8ffb8e7    INDEX     c   CREATE INDEX idx_dfbfa030e8ffb8e7 ON public.diagnostico_plantel USING btree (idcondicionbarda_id);
 (   DROP INDEX public.idx_dfbfa030e8ffb8e7;
       public            postgres    false    203            �           1259    59262    idx_dfbfa030f31154f5    INDEX     b   CREATE INDEX idx_dfbfa030f31154f5 ON public.diagnostico_plantel USING btree (idcondicionagua_id);
 (   DROP INDEX public.idx_dfbfa030f31154f5;
       public            postgres    false    203            �           1259    59272    idx_f3e428077a94ba1a    INDEX     f   CREATE INDEX idx_f3e428077a94ba1a ON public.condicion_educativa_alumnos USING btree (diagnostico_id);
 (   DROP INDEX public.idx_f3e428077a94ba1a;
       public            postgres    false    204            �           1259    59273    idx_f3e4280791a441cc    INDEX     `   CREATE INDEX idx_f3e4280791a441cc ON public.condicion_educativa_alumnos USING btree (grado_id);
 (   DROP INDEX public.idx_f3e4280791a441cc;
       public            postgres    false    204            �           1259    59274    idx_f3e42807e33f8867    INDEX     b   CREATE INDEX idx_f3e42807e33f8867 ON public.condicion_educativa_alumnos USING btree (escuela_id);
 (   DROP INDEX public.idx_f3e42807e33f8867;
       public            postgres    false    204            �           1259    59217    idx_f6c6e2ce41cdebb0    INDEX     N   CREATE INDEX idx_f6c6e2ce41cdebb0 ON public.escuela USING btree (plantel_id);
 (   DROP INDEX public.idx_f6c6e2ce41cdebb0;
       public            postgres    false    198            �           2606    59372 "   control_gastos fk_141b8c4ca9b5e49a    FK CONSTRAINT     �   ALTER TABLE ONLY public.control_gastos
    ADD CONSTRAINT fk_141b8c4ca9b5e49a FOREIGN KEY (tipo_comprobante_id) REFERENCES public.tipo_comprobante(id);
 L   ALTER TABLE ONLY public.control_gastos DROP CONSTRAINT fk_141b8c4ca9b5e49a;
       public          postgres    false    200    197    3001            �           2606    59367 "   control_gastos fk_141b8c4cd5384f42    FK CONSTRAINT     �   ALTER TABLE ONLY public.control_gastos
    ADD CONSTRAINT fk_141b8c4cd5384f42 FOREIGN KEY (plantrabajo_id) REFERENCES public.plan_trabajo(id);
 L   ALTER TABLE ONLY public.control_gastos DROP CONSTRAINT fk_141b8c4cd5384f42;
       public          postgres    false    209    200    3052            �           2606    59362 )   escuela_tipo_ensenanza fk_17fbbcc02f92be1    FK CONSTRAINT     �   ALTER TABLE ONLY public.escuela_tipo_ensenanza
    ADD CONSTRAINT fk_17fbbcc02f92be1 FOREIGN KEY (tipo_ensenanza_id) REFERENCES public.tipo_ensenanza(id) ON DELETE CASCADE;
 S   ALTER TABLE ONLY public.escuela_tipo_ensenanza DROP CONSTRAINT fk_17fbbcc02f92be1;
       public          postgres    false    199    3039    205            �           2606    59357 *   escuela_tipo_ensenanza fk_17fbbcc0e33f8867    FK CONSTRAINT     �   ALTER TABLE ONLY public.escuela_tipo_ensenanza
    ADD CONSTRAINT fk_17fbbcc0e33f8867 FOREIGN KEY (escuela_id) REFERENCES public.escuela(id) ON DELETE CASCADE;
 T   ALTER TABLE ONLY public.escuela_tipo_ensenanza DROP CONSTRAINT fk_17fbbcc0e33f8867;
       public          postgres    false    199    3003    198                       2606    59487 /   condicion_docente_educativa fk_1cea54b77a94ba1a    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT fk_1cea54b77a94ba1a FOREIGN KEY (diagnostico_id) REFERENCES public.diagnostico_plantel(id);
 Y   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT fk_1cea54b77a94ba1a;
       public          postgres    false    203    3018    211                       2606    59492 /   condicion_docente_educativa fk_1cea54b791a441cc    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT fk_1cea54b791a441cc FOREIGN KEY (grado_id) REFERENCES public.grado_ensenanza(id);
 Y   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT fk_1cea54b791a441cc;
       public          postgres    false    211    3047    208                       2606    59497 /   condicion_docente_educativa fk_1cea54b7e33f8867    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_docente_educativa
    ADD CONSTRAINT fk_1cea54b7e33f8867 FOREIGN KEY (escuela_id) REFERENCES public.escuela(id);
 Y   ALTER TABLE ONLY public.condicion_docente_educativa DROP CONSTRAINT fk_1cea54b7e33f8867;
       public          postgres    false    3003    211    198                       2606    59472 #   grado_ensenanza fk_2877888eda33e9e7    FK CONSTRAINT     �   ALTER TABLE ONLY public.grado_ensenanza
    ADD CONSTRAINT fk_2877888eda33e9e7 FOREIGN KEY (tipoensenanza_id) REFERENCES public.tipo_ensenanza(id);
 M   ALTER TABLE ONLY public.grado_ensenanza DROP CONSTRAINT fk_2877888eda33e9e7;
       public          postgres    false    3039    205    208                       2606    59477     plan_trabajo fk_4369f00241cdebb0    FK CONSTRAINT     �   ALTER TABLE ONLY public.plan_trabajo
    ADD CONSTRAINT fk_4369f00241cdebb0 FOREIGN KEY (plantel_id) REFERENCES public.plantel(id);
 J   ALTER TABLE ONLY public.plan_trabajo DROP CONSTRAINT fk_4369f00241cdebb0;
       public          postgres    false    209    3014    201                       2606    59482     plan_trabajo fk_4369f002dd25ed3b    FK CONSTRAINT     �   ALTER TABLE ONLY public.plan_trabajo
    ADD CONSTRAINT fk_4369f002dd25ed3b FOREIGN KEY (tipo_accion_id) REFERENCES public.tipo_accion(id);
 J   ALTER TABLE ONLY public.plan_trabajo DROP CONSTRAINT fk_4369f002dd25ed3b;
       public          postgres    false    209    210    3054            
           2606    59462 %   rendicion_cuentas fk_48b38885d5384f42    FK CONSTRAINT     �   ALTER TABLE ONLY public.rendicion_cuentas
    ADD CONSTRAINT fk_48b38885d5384f42 FOREIGN KEY (plantrabajo_id) REFERENCES public.plan_trabajo(id);
 O   ALTER TABLE ONLY public.rendicion_cuentas DROP CONSTRAINT fk_48b38885d5384f42;
       public          postgres    false    3052    209    206                       2606    59467 %   rendicion_cuentas fk_48b38885dd25ed3b    FK CONSTRAINT     �   ALTER TABLE ONLY public.rendicion_cuentas
    ADD CONSTRAINT fk_48b38885dd25ed3b FOREIGN KEY (tipo_accion_id) REFERENCES public.tipo_accion(id);
 O   ALTER TABLE ONLY public.rendicion_cuentas DROP CONSTRAINT fk_48b38885dd25ed3b;
       public          postgres    false    3054    206    210            �           2606    59407 '   diagnostico_plantel fk_dfbfa0301877de2e    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa0301877de2e FOREIGN KEY (idcondicionpatio_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa0301877de2e;
       public          postgres    false    3045    207    203                       2606    59427 '   diagnostico_plantel fk_dfbfa0302ac83a8a    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa0302ac83a8a FOREIGN KEY (idcondiciondrenaje_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa0302ac83a8a;
       public          postgres    false    203    207    3045                       2606    59432 '   diagnostico_plantel fk_dfbfa030311b18f1    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030311b18f1 FOREIGN KEY (idcondicionenergia_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030311b18f1;
       public          postgres    false    203    3045    207            �           2606    59377 '   diagnostico_plantel fk_dfbfa03041cdebb0    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa03041cdebb0 FOREIGN KEY (plantel_id) REFERENCES public.plantel(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa03041cdebb0;
       public          postgres    false    203    3014    201            �           2606    59397 '   diagnostico_plantel fk_dfbfa0305128e947    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa0305128e947 FOREIGN KEY (idcondicionesbliblioteca_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa0305128e947;
       public          postgres    false    3045    203    207            �           2606    59387 '   diagnostico_plantel fk_dfbfa030612be04d    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030612be04d FOREIGN KEY (idcondicionessanitarios_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030612be04d;
       public          postgres    false    203    207    3045            �           2606    59392 '   diagnostico_plantel fk_dfbfa03083cd1575    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa03083cd1575 FOREIGN KEY (idcondicionoficina_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa03083cd1575;
       public          postgres    false    203    3045    207                       2606    59437 '   diagnostico_plantel fk_dfbfa030880e9d7d    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030880e9d7d FOREIGN KEY (idcondiciontelefono_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030880e9d7d;
       public          postgres    false    203    207    3045            �           2606    59382 '   diagnostico_plantel fk_dfbfa030a85158d1    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030a85158d1 FOREIGN KEY (idcondiciones_aula_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030a85158d1;
       public          postgres    false    3045    207    203                       2606    59442 '   diagnostico_plantel fk_dfbfa030aa9185d8    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030aa9185d8 FOREIGN KEY (idcondicioninternet_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030aa9185d8;
       public          postgres    false    203    207    3045            �           2606    59402 '   diagnostico_plantel fk_dfbfa030d0ca6419    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030d0ca6419 FOREIGN KEY (idcondicionaulamedios_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030d0ca6419;
       public          postgres    false    203    3045    207                        2606    59412 '   diagnostico_plantel fk_dfbfa030e241bcd3    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030e241bcd3 FOREIGN KEY (idcondicioncanchasdeportivas_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030e241bcd3;
       public          postgres    false    207    203    3045                       2606    59417 '   diagnostico_plantel fk_dfbfa030e8ffb8e7    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030e8ffb8e7 FOREIGN KEY (idcondicionbarda_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030e8ffb8e7;
       public          postgres    false    203    3045    207                       2606    59422 '   diagnostico_plantel fk_dfbfa030f31154f5    FK CONSTRAINT     �   ALTER TABLE ONLY public.diagnostico_plantel
    ADD CONSTRAINT fk_dfbfa030f31154f5 FOREIGN KEY (idcondicionagua_id) REFERENCES public.tipo_condicion(id);
 Q   ALTER TABLE ONLY public.diagnostico_plantel DROP CONSTRAINT fk_dfbfa030f31154f5;
       public          postgres    false    3045    203    207                       2606    59447 /   condicion_educativa_alumnos fk_f3e428077a94ba1a    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT fk_f3e428077a94ba1a FOREIGN KEY (diagnostico_id) REFERENCES public.diagnostico_plantel(id);
 Y   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT fk_f3e428077a94ba1a;
       public          postgres    false    203    3018    204                       2606    59452 /   condicion_educativa_alumnos fk_f3e4280791a441cc    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT fk_f3e4280791a441cc FOREIGN KEY (grado_id) REFERENCES public.grado_ensenanza(id);
 Y   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT fk_f3e4280791a441cc;
       public          postgres    false    204    208    3047            	           2606    59457 /   condicion_educativa_alumnos fk_f3e42807e33f8867    FK CONSTRAINT     �   ALTER TABLE ONLY public.condicion_educativa_alumnos
    ADD CONSTRAINT fk_f3e42807e33f8867 FOREIGN KEY (escuela_id) REFERENCES public.escuela(id);
 Y   ALTER TABLE ONLY public.condicion_educativa_alumnos DROP CONSTRAINT fk_f3e42807e33f8867;
       public          postgres    false    198    3003    204            �           2606    59352    escuela fk_f6c6e2ce41cdebb0    FK CONSTRAINT        ALTER TABLE ONLY public.escuela
    ADD CONSTRAINT fk_f6c6e2ce41cdebb0 FOREIGN KEY (plantel_id) REFERENCES public.plantel(id);
 E   ALTER TABLE ONLY public.escuela DROP CONSTRAINT fk_f6c6e2ce41cdebb0;
       public          postgres    false    198    201    3014            �   )   x�3�4�4�4�426a.c(��Ę������Ԍ+F��� y��      �      x�3�4�4�4�46�4������� ��      �   Z   x�3�44�4�4202�50�54r@0'55O�45-���������D�9����(Q!%U� 1�$1'̆h5�52U0��F�zy�\1z\\\ ��      �   d   x�3�4����А3'55O�45-�$9���")�\�9����(Q!%U� 1�$1'�6202�50�52P04�55�55�+�K焈��q����b���� �%&�      �   '   x�3�4�LO+�J��46�2�J*K3A����+F��� �	      �      x�3�4�2�4bc.# ���� R�      �   4   x�3���v
qt��4�2�tt	u��񍸌9]}<}=�@<�=... �
�      �   D   x�Ż	�@E�xn1����� ��a�|�9nnǚ���Z��9IY&��TYh��-YcȎ�jpn�U�      �   �   x���;
�0Dk�����g�V�>'p�Dkc�	���Ȑ)��x���nq�����u�3��@�J='������k6E̒�5OS�;!�Cc=�O�2���㳺���p�T%�@%�OUk���۪���.�/��՞�Aܙ�,�y&B��5Z�;�J�      �      x�3�,NI�(����� �      �   X   x�%�1�  ������"��o�4��B�_��-�	"01!�H/�ͬc��ʚ��B���y_���}jk��(��c�\�8�~�=8���      �   t  x��T�nA��O1�-],'�&
 A�fnw�,ڟ�����IIA�x��ޝ�M��5>���~s��zIw�����Zr�%��hOI��(R�֨Jx?��\�5M@���$�`9�ܚ.J�=����.D�'ZR��%��
�2wV2��=����Τ����;^�	9�Л�}{Qy,<��J;�%�o$ٖh4kl�Ѹ��OP/sy��Oݺ��c9��/A(��'�ɞT���p���J��xeQ�����#S_$B�J
=�sZ�l&m��Ye�#uQ��.м�R��~	� ;5T-�p�h�_�2>*̳N�U�d��pK)l�W�r»hnV7�������y���Q'��BW��}oF)��<pMq�Ds��h+^�b�*��l�' s���MF�{4|P�1�6�H�/��IeH1bk�`z�T�WGרG Q��;�Kt2p�6���4�=|W9��R����&eqc�x[�0�(��g�2x.�D窿jn�U�}U���(5j�ǵ�be9;~,�	9}*��(h}��[K"ܯ�����v�q����R1��a>&EU1� �z(�@Fv}]SU8 �e;ƥrBl���_�~��D��&r\��Ŗn?~X��[��崼��~9��~��b      �   �   x���1�0E��> Dm��	!����ڄ�)R���IX�`b����ϩ���m��iY�����D�29�@(ܓ��IĶ#�}�c҆��z��;���z�JZ~qf�ؑ�TM5���֍Z��� ��:���1R༗�)1��سl���RT���k�6v��̭'T��<\}p%}Jl�H�M���}4Z��tb      �   &   x�3�t*M���2��M���2�JM/�I,����� ~��      �   *   x�3����KI-�2�(��M,�L�2�NM.�Ksb���� �)     