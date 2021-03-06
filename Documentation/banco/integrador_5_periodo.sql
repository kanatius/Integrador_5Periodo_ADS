toc.dat                                                                                             0000600 0004000 0002000 00000074125 13762305036 0014455 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP                            x            banco_wiki_integrador    12.2    12.2 `    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false         �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false         �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false         �           1262    109605    banco_wiki_integrador    DATABASE     �   CREATE DATABASE banco_wiki_integrador WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
 %   DROP DATABASE banco_wiki_integrador;
                postgres    false         �            1255    117586    save_state_of_reservation()    FUNCTION     �  CREATE FUNCTION public.save_state_of_reservation() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
	begin
		insert into reserva_log
		(id_usuario, id_reserva, id_quarto, id_situacao_de_pagamento, data_entrada, 
		 data_saida, valor_a_pagar, updated_at) 
		values (OLD.id_usuario, OLD.id, OLD.id_quarto, OLD.id_situacao_de_pagamento,
			   OLD.data_entrada, OLD.data_saida, OLD.valor_a_pagar, now());
		return NULL;
	end
$$;
 2   DROP FUNCTION public.save_state_of_reservation();
       public          postgres    false         �            1259    109626    reserva    TABLE     j  CREATE TABLE public.reserva (
    id bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id_quarto bigint NOT NULL,
    id_situacao_de_pagamento bigint NOT NULL,
    data_entrada date NOT NULL,
    data_saida date NOT NULL,
    valor_a_pagar numeric(8,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.reserva;
       public         heap    postgres    false         �            1255    117584 )   save_state_of_reservation(public.reserva) 	   PROCEDURE     �  CREATE PROCEDURE public.save_state_of_reservation(reservation public.reserva)
    LANGUAGE plpgsql
    AS $$
	begin
		insert into reserva_log
		(id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, 
		 data_saida, valor_a_pagar, updated_at) 
		values (reservation.id_usuario, reservation.id_quarto, reservation.id_situacao_de_pagamento,
			   reservation.data_entrada, reservation.data_saida, reservation.valor_a_pagar, now());
	end
$$;
 M   DROP PROCEDURE public.save_state_of_reservation(reservation public.reserva);
       public          postgres    false    210         �            1259    109606    endereco    TABLE     ^  CREATE TABLE public.endereco (
    id bigint NOT NULL,
    rua character varying(255) NOT NULL,
    numero integer NOT NULL,
    bairro character varying(55) NOT NULL,
    cidade character varying(55) NOT NULL,
    estado character varying(55) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.endereco;
       public         heap    postgres    false         �            1259    109609    endereco_id_seq    SEQUENCE     x   CREATE SEQUENCE public.endereco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.endereco_id_seq;
       public          postgres    false    202         �           0    0    endereco_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.endereco_id_seq OWNED BY public.endereco.id;
          public          postgres    false    203         �            1259    109611    estabelecimento    TABLE       CREATE TABLE public.estabelecimento (
    id bigint NOT NULL,
    nome character varying(100) NOT NULL,
    id_endereco bigint NOT NULL,
    id_tipo_de_estabelecimento bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 #   DROP TABLE public.estabelecimento;
       public         heap    postgres    false         �            1259    109614    estabelecimento_id_seq    SEQUENCE        CREATE SEQUENCE public.estabelecimento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.estabelecimento_id_seq;
       public          postgres    false    204         �           0    0    estabelecimento_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.estabelecimento_id_seq OWNED BY public.estabelecimento.id;
          public          postgres    false    205         �            1259    109616 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false         �            1259    109619    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    206         �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    207         �            1259    109621    quarto    TABLE     >  CREATE TABLE public.quarto (
    id bigint NOT NULL,
    andar integer NOT NULL,
    numero integer NOT NULL,
    valor numeric(8,2) NOT NULL,
    id_tipo_de_quarto bigint NOT NULL,
    id_estabelecimento bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.quarto;
       public         heap    postgres    false         �            1259    109624    quarto_id_seq    SEQUENCE     v   CREATE SEQUENCE public.quarto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.quarto_id_seq;
       public          postgres    false    208         �           0    0    quarto_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.quarto_id_seq OWNED BY public.quarto.id;
          public          postgres    false    209         �            1259    109629    reserva_id_seq    SEQUENCE     w   CREATE SEQUENCE public.reserva_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.reserva_id_seq;
       public          postgres    false    210         �           0    0    reserva_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.reserva_id_seq OWNED BY public.reserva.id;
          public          postgres    false    211         �            1259    117616    reserva_log    TABLE     "  CREATE TABLE public.reserva_log (
    id integer NOT NULL,
    id_reserva integer,
    id_usuario integer,
    id_quarto integer,
    id_situacao_de_pagamento integer,
    data_entrada date,
    data_saida date,
    valor_a_pagar numeric(8,2),
    updated_at timestamp without time zone
);
    DROP TABLE public.reserva_log;
       public         heap    postgres    false         �            1259    117614    reserva_log_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reserva_log_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.reserva_log_id_seq;
       public          postgres    false    223         �           0    0    reserva_log_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.reserva_log_id_seq OWNED BY public.reserva_log.id;
          public          postgres    false    222         �            1259    109631    situacao_de_pagamento    TABLE     �   CREATE TABLE public.situacao_de_pagamento (
    id bigint NOT NULL,
    nome character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 )   DROP TABLE public.situacao_de_pagamento;
       public         heap    postgres    false         �            1259    109634    situacao_de_pagamento_id_seq    SEQUENCE     �   CREATE SEQUENCE public.situacao_de_pagamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.situacao_de_pagamento_id_seq;
       public          postgres    false    212         �           0    0    situacao_de_pagamento_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.situacao_de_pagamento_id_seq OWNED BY public.situacao_de_pagamento.id;
          public          postgres    false    213         �            1259    109636    status_do_quarto    TABLE     �   CREATE TABLE public.status_do_quarto (
    id bigint NOT NULL,
    nome character varying(55) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.status_do_quarto;
       public         heap    postgres    false         �            1259    109639    status_do_quarto_id_seq    SEQUENCE     �   CREATE SEQUENCE public.status_do_quarto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.status_do_quarto_id_seq;
       public          postgres    false    214         �           0    0    status_do_quarto_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.status_do_quarto_id_seq OWNED BY public.status_do_quarto.id;
          public          postgres    false    215         �            1259    109641    tipo_de_estabelecimento    TABLE     �   CREATE TABLE public.tipo_de_estabelecimento (
    id bigint NOT NULL,
    nome character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 +   DROP TABLE public.tipo_de_estabelecimento;
       public         heap    postgres    false         �            1259    109644    tipo_de_estabelecimento_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_de_estabelecimento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tipo_de_estabelecimento_id_seq;
       public          postgres    false    216         �           0    0    tipo_de_estabelecimento_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tipo_de_estabelecimento_id_seq OWNED BY public.tipo_de_estabelecimento.id;
          public          postgres    false    217         �            1259    109646    tipo_de_quarto    TABLE     �   CREATE TABLE public.tipo_de_quarto (
    id bigint NOT NULL,
    nome character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 "   DROP TABLE public.tipo_de_quarto;
       public         heap    postgres    false         �            1259    109649    tipo_de_quarto_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.tipo_de_quarto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tipo_de_quarto_id_seq;
       public          postgres    false    218         �           0    0    tipo_de_quarto_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tipo_de_quarto_id_seq OWNED BY public.tipo_de_quarto.id;
          public          postgres    false    219         �            1259    109651    usuario    TABLE       CREATE TABLE public.usuario (
    id bigint NOT NULL,
    nome character varying(100) NOT NULL,
    email character varying(255) NOT NULL,
    token character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.usuario;
       public         heap    postgres    false         �            1259    109654    usuario_id_seq    SEQUENCE     w   CREATE SEQUENCE public.usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.usuario_id_seq;
       public          postgres    false    220         �           0    0    usuario_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;
          public          postgres    false    221         �
           2604    109656    endereco id    DEFAULT     j   ALTER TABLE ONLY public.endereco ALTER COLUMN id SET DEFAULT nextval('public.endereco_id_seq'::regclass);
 :   ALTER TABLE public.endereco ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    203    202         �
           2604    109657    estabelecimento id    DEFAULT     x   ALTER TABLE ONLY public.estabelecimento ALTER COLUMN id SET DEFAULT nextval('public.estabelecimento_id_seq'::regclass);
 A   ALTER TABLE public.estabelecimento ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    205    204         �
           2604    109658    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    207    206         �
           2604    109659 	   quarto id    DEFAULT     f   ALTER TABLE ONLY public.quarto ALTER COLUMN id SET DEFAULT nextval('public.quarto_id_seq'::regclass);
 8   ALTER TABLE public.quarto ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    209    208         �
           2604    109660 
   reserva id    DEFAULT     h   ALTER TABLE ONLY public.reserva ALTER COLUMN id SET DEFAULT nextval('public.reserva_id_seq'::regclass);
 9   ALTER TABLE public.reserva ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    210         �
           2604    117619    reserva_log id    DEFAULT     p   ALTER TABLE ONLY public.reserva_log ALTER COLUMN id SET DEFAULT nextval('public.reserva_log_id_seq'::regclass);
 =   ALTER TABLE public.reserva_log ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222    223         �
           2604    109661    situacao_de_pagamento id    DEFAULT     �   ALTER TABLE ONLY public.situacao_de_pagamento ALTER COLUMN id SET DEFAULT nextval('public.situacao_de_pagamento_id_seq'::regclass);
 G   ALTER TABLE public.situacao_de_pagamento ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    213    212         �
           2604    109662    status_do_quarto id    DEFAULT     z   ALTER TABLE ONLY public.status_do_quarto ALTER COLUMN id SET DEFAULT nextval('public.status_do_quarto_id_seq'::regclass);
 B   ALTER TABLE public.status_do_quarto ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214         �
           2604    109663    tipo_de_estabelecimento id    DEFAULT     �   ALTER TABLE ONLY public.tipo_de_estabelecimento ALTER COLUMN id SET DEFAULT nextval('public.tipo_de_estabelecimento_id_seq'::regclass);
 I   ALTER TABLE public.tipo_de_estabelecimento ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216         �
           2604    109664    tipo_de_quarto id    DEFAULT     v   ALTER TABLE ONLY public.tipo_de_quarto ALTER COLUMN id SET DEFAULT nextval('public.tipo_de_quarto_id_seq'::regclass);
 @   ALTER TABLE public.tipo_de_quarto ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    218         �
           2604    109665 
   usuario id    DEFAULT     h   ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);
 9   ALTER TABLE public.usuario ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    220         j          0    109606    endereco 
   TABLE DATA           c   COPY public.endereco (id, rua, numero, bairro, cidade, estado, created_at, updated_at) FROM stdin;
    public          postgres    false    202       2922.dat l          0    109611    estabelecimento 
   TABLE DATA           t   COPY public.estabelecimento (id, nome, id_endereco, id_tipo_de_estabelecimento, created_at, updated_at) FROM stdin;
    public          postgres    false    204       2924.dat n          0    109616 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    206       2926.dat p          0    109621    quarto 
   TABLE DATA           y   COPY public.quarto (id, andar, numero, valor, id_tipo_de_quarto, id_estabelecimento, created_at, updated_at) FROM stdin;
    public          postgres    false    208       2928.dat r          0    109626    reserva 
   TABLE DATA           �   COPY public.reserva (id, id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, data_saida, valor_a_pagar, created_at, updated_at) FROM stdin;
    public          postgres    false    210       2930.dat           0    117616    reserva_log 
   TABLE DATA           �   COPY public.reserva_log (id, id_reserva, id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, data_saida, valor_a_pagar, updated_at) FROM stdin;
    public          postgres    false    223       2943.dat t          0    109631    situacao_de_pagamento 
   TABLE DATA           Q   COPY public.situacao_de_pagamento (id, nome, created_at, updated_at) FROM stdin;
    public          postgres    false    212       2932.dat v          0    109636    status_do_quarto 
   TABLE DATA           L   COPY public.status_do_quarto (id, nome, created_at, updated_at) FROM stdin;
    public          postgres    false    214       2934.dat x          0    109641    tipo_de_estabelecimento 
   TABLE DATA           S   COPY public.tipo_de_estabelecimento (id, nome, created_at, updated_at) FROM stdin;
    public          postgres    false    216       2936.dat z          0    109646    tipo_de_quarto 
   TABLE DATA           J   COPY public.tipo_de_quarto (id, nome, created_at, updated_at) FROM stdin;
    public          postgres    false    218       2938.dat |          0    109651    usuario 
   TABLE DATA           Q   COPY public.usuario (id, nome, email, token, created_at, updated_at) FROM stdin;
    public          postgres    false    220       2940.dat �           0    0    endereco_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.endereco_id_seq', 20, true);
          public          postgres    false    203         �           0    0    estabelecimento_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.estabelecimento_id_seq', 20, true);
          public          postgres    false    205         �           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 40, true);
          public          postgres    false    207         �           0    0    quarto_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.quarto_id_seq', 200, true);
          public          postgres    false    209         �           0    0    reserva_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.reserva_id_seq', 117, true);
          public          postgres    false    211         �           0    0    reserva_log_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.reserva_log_id_seq', 2, true);
          public          postgres    false    222         �           0    0    situacao_de_pagamento_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.situacao_de_pagamento_id_seq', 1, false);
          public          postgres    false    213         �           0    0    status_do_quarto_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.status_do_quarto_id_seq', 1, false);
          public          postgres    false    215         �           0    0    tipo_de_estabelecimento_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tipo_de_estabelecimento_id_seq', 1, false);
          public          postgres    false    217         �           0    0    tipo_de_quarto_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.tipo_de_quarto_id_seq', 1, false);
          public          postgres    false    219         �           0    0    usuario_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.usuario_id_seq', 6, true);
          public          postgres    false    221         �
           2606    109667    endereco endereco_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT endereco_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.endereco DROP CONSTRAINT endereco_pkey;
       public            postgres    false    202         �
           2606    109669 2   estabelecimento estabelecimento_id_endereco_unique 
   CONSTRAINT     t   ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_id_endereco_unique UNIQUE (id_endereco);
 \   ALTER TABLE ONLY public.estabelecimento DROP CONSTRAINT estabelecimento_id_endereco_unique;
       public            postgres    false    204         �
           2606    109671 $   estabelecimento estabelecimento_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.estabelecimento DROP CONSTRAINT estabelecimento_pkey;
       public            postgres    false    204         �
           2606    109673    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    206         �
           2606    109675    quarto quarto_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.quarto
    ADD CONSTRAINT quarto_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.quarto DROP CONSTRAINT quarto_pkey;
       public            postgres    false    208         �
           2606    109677    reserva reserva_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.reserva DROP CONSTRAINT reserva_pkey;
       public            postgres    false    210         �
           2606    109679 0   situacao_de_pagamento situacao_de_pagamento_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.situacao_de_pagamento
    ADD CONSTRAINT situacao_de_pagamento_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.situacao_de_pagamento DROP CONSTRAINT situacao_de_pagamento_pkey;
       public            postgres    false    212         �
           2606    109681 &   status_do_quarto status_do_quarto_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.status_do_quarto
    ADD CONSTRAINT status_do_quarto_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.status_do_quarto DROP CONSTRAINT status_do_quarto_pkey;
       public            postgres    false    214         �
           2606    109683 4   tipo_de_estabelecimento tipo_de_estabelecimento_pkey 
   CONSTRAINT     r   ALTER TABLE ONLY public.tipo_de_estabelecimento
    ADD CONSTRAINT tipo_de_estabelecimento_pkey PRIMARY KEY (id);
 ^   ALTER TABLE ONLY public.tipo_de_estabelecimento DROP CONSTRAINT tipo_de_estabelecimento_pkey;
       public            postgres    false    216         �
           2606    109685 "   tipo_de_quarto tipo_de_quarto_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tipo_de_quarto
    ADD CONSTRAINT tipo_de_quarto_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.tipo_de_quarto DROP CONSTRAINT tipo_de_quarto_pkey;
       public            postgres    false    218         �
           2606    109687    usuario usuario_email_unique 
   CONSTRAINT     X   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_email_unique UNIQUE (email);
 F   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_email_unique;
       public            postgres    false    220         �
           2606    109689    usuario usuario_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public            postgres    false    220         �
           2620    117587 +   reserva save_date_reservation_before_update    TRIGGER     �   CREATE TRIGGER save_date_reservation_before_update BEFORE DELETE OR UPDATE ON public.reserva FOR EACH ROW EXECUTE FUNCTION public.save_state_of_reservation();
 D   DROP TRIGGER save_date_reservation_before_update ON public.reserva;
       public          postgres    false    225    210         �
           2606    109690 3   estabelecimento estabelecimento_id_endereco_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_id_endereco_foreign FOREIGN KEY (id_endereco) REFERENCES public.endereco(id);
 ]   ALTER TABLE ONLY public.estabelecimento DROP CONSTRAINT estabelecimento_id_endereco_foreign;
       public          postgres    false    204    2761    202         �
           2606    109695 B   estabelecimento estabelecimento_id_tipo_de_estabelecimento_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_id_tipo_de_estabelecimento_foreign FOREIGN KEY (id_tipo_de_estabelecimento) REFERENCES public.tipo_de_estabelecimento(id);
 l   ALTER TABLE ONLY public.estabelecimento DROP CONSTRAINT estabelecimento_id_tipo_de_estabelecimento_foreign;
       public          postgres    false    216    2777    204         �
           2606    109700 (   quarto quarto_id_estabelecimento_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.quarto
    ADD CONSTRAINT quarto_id_estabelecimento_foreign FOREIGN KEY (id_estabelecimento) REFERENCES public.estabelecimento(id);
 R   ALTER TABLE ONLY public.quarto DROP CONSTRAINT quarto_id_estabelecimento_foreign;
       public          postgres    false    2765    204    208         �
           2606    109705 '   quarto quarto_id_tipo_de_quarto_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.quarto
    ADD CONSTRAINT quarto_id_tipo_de_quarto_foreign FOREIGN KEY (id_tipo_de_quarto) REFERENCES public.tipo_de_quarto(id);
 Q   ALTER TABLE ONLY public.quarto DROP CONSTRAINT quarto_id_tipo_de_quarto_foreign;
       public          postgres    false    208    218    2779         �
           2606    109710 !   reserva reserva_id_quarto_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_id_quarto_foreign FOREIGN KEY (id_quarto) REFERENCES public.quarto(id);
 K   ALTER TABLE ONLY public.reserva DROP CONSTRAINT reserva_id_quarto_foreign;
       public          postgres    false    210    208    2769         �
           2606    109715 0   reserva reserva_id_situacao_de_pagamento_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_id_situacao_de_pagamento_foreign FOREIGN KEY (id_situacao_de_pagamento) REFERENCES public.situacao_de_pagamento(id);
 Z   ALTER TABLE ONLY public.reserva DROP CONSTRAINT reserva_id_situacao_de_pagamento_foreign;
       public          postgres    false    210    212    2773         �
           2606    109720 "   reserva reserva_id_usuario_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES public.usuario(id);
 L   ALTER TABLE ONLY public.reserva DROP CONSTRAINT reserva_id_usuario_foreign;
       public          postgres    false    210    2783    220         �
           2606    117630 &   reserva_log reserva_log_id_quarto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_quarto_fkey FOREIGN KEY (id_quarto) REFERENCES public.quarto(id);
 P   ALTER TABLE ONLY public.reserva_log DROP CONSTRAINT reserva_log_id_quarto_fkey;
       public          postgres    false    223    208    2769         �
           2606    117620 '   reserva_log reserva_log_id_reserva_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_reserva_fkey FOREIGN KEY (id_reserva) REFERENCES public.reserva(id);
 Q   ALTER TABLE ONLY public.reserva_log DROP CONSTRAINT reserva_log_id_reserva_fkey;
       public          postgres    false    2771    223    210         �
           2606    117635 5   reserva_log reserva_log_id_situacao_de_pagamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_situacao_de_pagamento_fkey FOREIGN KEY (id_situacao_de_pagamento) REFERENCES public.situacao_de_pagamento(id);
 _   ALTER TABLE ONLY public.reserva_log DROP CONSTRAINT reserva_log_id_situacao_de_pagamento_fkey;
       public          postgres    false    223    2773    212         �
           2606    117625 '   reserva_log reserva_log_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id);
 Q   ALTER TABLE ONLY public.reserva_log DROP CONSTRAINT reserva_log_id_usuario_fkey;
       public          postgres    false    223    2783    220                                                                                                                                                                                                                                                                                                                                                                                                                                                   2922.dat                                                                                            0000600 0004000 0002000 00000003415 13762305036 0014260 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	R. Dix-Sept Rosado	56	Estação	Alexandria	Rio Grande do Norte	2020-10-22 13:56:34	\N
2	R. Severino Rêgo	0	Alto do Açude	Pau dos Ferros	Rio Grande do Norte	2020-10-22 13:56:35	\N
3	Rua Correia Dias	368	Paraíso	São Paulo	São Paulo	2020-10-22 13:56:36	\N
4	R. Barão da Torre	600	Ipanema	Rio de Janeiro	Rio de Janeiro	2020-10-22 13:56:38	\N
5	R. Afonso Célso	119	Barra	Salvador	Bahia	2020-10-22 13:56:39	\N
6	R. Carapeba	100	Ponta Negra	Natal	Rio Grande do Norte	2020-10-22 13:56:41	\N
7	R. Duque Estrada	115	Imbiribeira	Recife	Pernambuco	2020-10-22 13:56:42	\N
8	R. Hermes de Castro Santos	80	Pres. Costa e Silva	Mossoró	Rio Grande do Norte	2020-10-22 13:56:43	\N
9	R. São Francisco	30	Santana	Porto Alegre	Rio Grande do Sul	2020-10-22 13:56:45	\N
10	St. de Habitações Coletivas e Geminadas Norte	712	Asa Norte	Brasília	Distrito Federal	2020-10-22 13:56:46	\N
11	R. Santo Antonio	209	Santo Antonio	Alexandria	Rio Grande do Norte	2020-10-22 13:56:47	\N
12	R. da Independência	1705	Centro	Pau dos Ferros	Rio Grande do Norte	2020-10-22 13:56:49	\N
13	R. Sampaio Viana	425	Paraíso	São Paulo	São Paulo	2020-10-22 13:56:50	\N
14	R. Prof. Euríco Rabêlo	16	Maracanã	Rio de Janeiro	Rio de Janeiro	2020-10-22 13:56:51	\N
15	Tv. Prudente de Morães	65	Rio Vermelho	Salvador	Bahia	2020-10-22 13:56:52	\N
16	Av. Pres. Café Filho	1176	Praia dos Artistas	Natal	Rio Grande do Norte	2020-10-22 13:56:54	\N
17	R. Félix de Brito e Melo	382	Boa Viagem	Recife	Pernambuco	2020-10-22 13:56:55	\N
18	Av. Lauro Monte	2001	Santo Antônio	Mossoró	Rio Grande do Norte	2020-10-22 13:56:56	\N
19	Av. Osvaldo Aranha	390	Bom Fim	Porto Alegre	Rio Grande do Sul	2020-10-22 13:56:58	\N
20	SHTN Trecho 01 Conjunto 01, Setor de Hotéis e Turismo Norte	56	Asa Norte	Brasília	Distrito Fereral	2020-10-22 13:56:59	\N
\.


                                                                                                                                                                                                                                                   2924.dat                                                                                            0000600 0004000 0002000 00000001753 13762305036 0014265 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Pousada do Elísio	1	1	2020-10-22 13:56:34	\N
2	Pousada Mão Preta	2	1	2020-10-22 13:56:36	\N
3	Pousada Bonita	3	1	2020-10-22 13:56:37	\N
4	Margarida's Pousada	4	1	2020-10-22 13:56:39	\N
5	Estrela do Mar	5	1	2020-10-22 13:56:40	\N
6	Natal Paradise	6	1	2020-10-22 13:56:41	\N
7	Pousada Sol e Mar	7	1	2020-10-22 13:56:43	\N
8	Ruta Del Sol	8	1	2020-10-22 13:56:44	\N
9	Pousada Terra Sul	9	1	2020-10-22 13:56:45	\N
10	Pousada Damasco	10	1	2020-10-22 13:56:47	\N
11	Hotel Alexandriense	11	2	2020-10-22 13:56:48	\N
12	Hertz Center Hotel	12	2	2020-10-22 13:56:49	\N
13	Transamerica Prime Paradise Garden	13	2	2020-10-22 13:56:51	\N
14	República Maracanã Hostel Vila Isabel	14	2	2020-10-22 13:56:52	\N
15	The Hostel Salvador	15	2	2020-10-22 13:56:53	\N
16	Hotel Bruma	16	2	2020-10-22 13:56:55	\N
17	Hotel Aconchego Recife	17	2	2020-10-22 13:56:56	\N
18	Hotel Thermas	18	2	2020-10-22 13:56:57	\N
19	Manhattan Apart-Hotel	19	2	2020-10-22 13:56:58	\N
20	Brasília Palace Hotel	20	2	2020-10-22 13:57:00	\N
\.


                     2926.dat                                                                                            0000600 0004000 0002000 00000001471 13762305036 0014264 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        23	2014_10_12_000000_create_users_table	1
24	2014_10_12_100000_create_password_resets_table	1
25	2019_08_19_000000_create_failed_jobs_table	1
26	2020_10_20_183809_create_endereco_table	1
27	2020_10_20_191820_create_tipo_de_estabelecimento	1
28	2020_10_20_191913_create_estabelecimento	1
29	2020_10_20_191932_create_usuario	1
30	2020_10_20_191954_create_tipo_de_quarto	1
31	2020_10_20_192016_create_status_do_quarto	1
32	2020_10_20_192028_create_quarto	1
33	2020_10_20_192052_create_situacao_de_pagamento	1
34	2020_10_20_192206_create_reserva	1
35	2020_10_20_194350_insert_tipo_de_estabelecimento	1
36	2020_10_20_194423_insert_tipos_de_quarto	1
37	2020_10_20_194450_insert_situacao_de_pagamento	1
38	2020_10_20_194508_insert_estabelecimentos	1
39	2020_10_20_194518_insert_quartos	1
40	2020_10_20_194533_insert_reservas	1
\.


                                                                                                                                                                                                       2928.dat                                                                                            0000600 0004000 0002000 00000020421 13762305036 0014262 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	2	1	150.00	1	1	2020-10-22 13:57:50	\N
2	1	2	150.00	1	1	2020-10-22 13:57:51	\N
3	1	3	150.00	1	1	2020-10-22 13:57:51	\N
4	0	4	150.00	1	1	2020-10-22 13:57:52	\N
5	1	5	150.00	1	1	2020-10-22 13:57:52	\N
6	1	6	250.00	2	1	2020-10-22 13:57:53	\N
7	1	7	250.00	2	1	2020-10-22 13:57:53	\N
8	2	8	250.00	2	1	2020-10-22 13:57:54	\N
9	1	9	250.00	2	1	2020-10-22 13:57:54	\N
10	0	10	250.00	2	1	2020-10-22 13:57:55	\N
11	1	1	150.00	1	2	2020-10-22 13:57:55	\N
12	0	2	150.00	1	2	2020-10-22 13:57:56	\N
13	0	3	150.00	1	2	2020-10-22 13:57:56	\N
14	2	4	150.00	1	2	2020-10-22 13:57:56	\N
15	0	5	150.00	1	2	2020-10-22 13:57:57	\N
16	0	6	250.00	2	2	2020-10-22 13:57:58	\N
17	2	7	250.00	2	2	2020-10-22 13:57:58	\N
18	2	8	250.00	2	2	2020-10-22 13:57:59	\N
19	2	9	250.00	2	2	2020-10-22 13:57:59	\N
20	2	10	250.00	2	2	2020-10-22 13:57:59	\N
21	1	1	150.00	1	3	2020-10-22 13:58:00	\N
22	0	2	150.00	1	3	2020-10-22 13:58:00	\N
23	0	3	150.00	1	3	2020-10-22 13:58:01	\N
24	0	4	150.00	1	3	2020-10-22 13:58:01	\N
25	1	5	150.00	1	3	2020-10-22 13:58:02	\N
26	0	6	250.00	2	3	2020-10-22 13:58:02	\N
27	0	7	250.00	2	3	2020-10-22 13:58:02	\N
28	1	8	250.00	2	3	2020-10-22 13:58:03	\N
29	2	9	250.00	2	3	2020-10-22 13:58:03	\N
30	2	10	250.00	2	3	2020-10-22 13:58:03	\N
31	1	1	150.00	1	4	2020-10-22 13:58:04	\N
32	2	2	150.00	1	4	2020-10-22 13:58:04	\N
33	1	3	150.00	1	4	2020-10-22 13:58:05	\N
34	2	4	150.00	1	4	2020-10-22 13:58:05	\N
35	1	5	150.00	1	4	2020-10-22 13:58:06	\N
36	0	6	250.00	2	4	2020-10-22 13:58:06	\N
37	1	7	250.00	2	4	2020-10-22 13:58:06	\N
38	2	8	250.00	2	4	2020-10-22 13:58:07	\N
39	0	9	250.00	2	4	2020-10-22 13:58:07	\N
40	0	10	250.00	2	4	2020-10-22 13:58:08	\N
41	0	1	150.00	1	5	2020-10-22 13:58:08	\N
42	2	2	150.00	1	5	2020-10-22 13:58:09	\N
43	1	3	150.00	1	5	2020-10-22 13:58:09	\N
44	0	4	150.00	1	5	2020-10-22 13:58:10	\N
45	2	5	150.00	1	5	2020-10-22 13:58:10	\N
46	0	6	250.00	2	5	2020-10-22 13:58:10	\N
47	0	7	250.00	2	5	2020-10-22 13:58:11	\N
48	0	8	250.00	2	5	2020-10-22 13:58:11	\N
49	1	9	250.00	2	5	2020-10-22 13:58:12	\N
50	2	10	250.00	2	5	2020-10-22 13:58:12	\N
51	0	1	150.00	1	6	2020-10-22 13:58:13	\N
52	1	2	150.00	1	6	2020-10-22 13:58:13	\N
53	2	3	150.00	1	6	2020-10-22 13:58:13	\N
54	2	4	150.00	1	6	2020-10-22 13:58:14	\N
55	2	5	150.00	1	6	2020-10-22 13:58:14	\N
56	0	6	250.00	2	6	2020-10-22 13:58:15	\N
57	0	7	250.00	2	6	2020-10-22 13:58:15	\N
58	2	8	250.00	2	6	2020-10-22 13:58:15	\N
59	0	9	250.00	2	6	2020-10-22 13:58:16	\N
60	0	10	250.00	2	6	2020-10-22 13:58:17	\N
61	2	1	150.00	1	7	2020-10-22 13:58:17	\N
62	2	2	150.00	1	7	2020-10-22 13:58:18	\N
63	1	3	150.00	1	7	2020-10-22 13:58:18	\N
64	1	4	150.00	1	7	2020-10-22 13:58:18	\N
65	0	5	150.00	1	7	2020-10-22 13:58:19	\N
66	0	6	250.00	2	7	2020-10-22 13:58:19	\N
67	1	7	250.00	2	7	2020-10-22 13:58:19	\N
68	1	8	250.00	2	7	2020-10-22 13:58:20	\N
69	0	9	250.00	2	7	2020-10-22 13:58:20	\N
70	1	10	250.00	2	7	2020-10-22 13:58:20	\N
71	0	1	150.00	1	8	2020-10-22 13:58:21	\N
72	1	2	150.00	1	8	2020-10-22 13:58:21	\N
73	2	3	150.00	1	8	2020-10-22 13:58:22	\N
74	0	4	150.00	1	8	2020-10-22 13:58:22	\N
75	0	5	150.00	1	8	2020-10-22 13:58:22	\N
76	2	6	250.00	2	8	2020-10-22 13:58:23	\N
77	2	7	250.00	2	8	2020-10-22 13:58:23	\N
78	1	8	250.00	2	8	2020-10-22 13:58:24	\N
79	0	9	250.00	2	8	2020-10-22 13:58:24	\N
80	2	10	250.00	2	8	2020-10-22 13:58:24	\N
81	1	1	150.00	1	9	2020-10-22 13:58:25	\N
82	2	2	150.00	1	9	2020-10-22 13:58:25	\N
83	1	3	150.00	1	9	2020-10-22 13:58:26	\N
84	2	4	150.00	1	9	2020-10-22 13:58:26	\N
85	1	5	150.00	1	9	2020-10-22 13:58:27	\N
86	2	6	250.00	2	9	2020-10-22 13:58:27	\N
87	0	7	250.00	2	9	2020-10-22 13:58:27	\N
88	0	8	250.00	2	9	2020-10-22 13:58:28	\N
89	2	9	250.00	2	9	2020-10-22 13:58:28	\N
90	2	10	250.00	2	9	2020-10-22 13:58:28	\N
91	0	1	150.00	1	10	2020-10-22 13:58:29	\N
92	2	2	150.00	1	10	2020-10-22 13:58:29	\N
93	2	3	150.00	1	10	2020-10-22 13:58:29	\N
94	2	4	150.00	1	10	2020-10-22 13:58:30	\N
95	2	5	150.00	1	10	2020-10-22 13:58:30	\N
96	1	6	250.00	2	10	2020-10-22 13:58:31	\N
97	0	7	250.00	2	10	2020-10-22 13:58:31	\N
98	2	8	250.00	2	10	2020-10-22 13:58:32	\N
99	0	9	250.00	2	10	2020-10-22 13:58:32	\N
100	2	10	250.00	2	10	2020-10-22 13:58:32	\N
101	2	1	300.00	1	11	2020-10-22 13:58:33	\N
102	3	2	300.00	1	11	2020-10-22 13:58:33	\N
103	4	3	300.00	1	11	2020-10-22 13:58:34	\N
104	3	4	300.00	1	11	2020-10-22 13:58:34	\N
105	5	5	300.00	1	11	2020-10-22 13:58:35	\N
106	8	6	500.00	2	11	2020-10-22 13:58:35	\N
107	13	7	500.00	2	11	2020-10-22 13:58:36	\N
108	16	8	500.00	2	11	2020-10-22 13:58:36	\N
109	6	9	500.00	2	11	2020-10-22 13:58:36	\N
110	16	10	500.00	2	11	2020-10-22 13:58:37	\N
111	1	1	300.00	1	12	2020-10-22 13:58:37	\N
112	5	2	300.00	1	12	2020-10-22 13:58:38	\N
113	5	3	300.00	1	12	2020-10-22 13:58:38	\N
114	1	4	300.00	1	12	2020-10-22 13:58:39	\N
115	5	5	300.00	1	12	2020-10-22 13:58:39	\N
116	12	6	500.00	2	12	2020-10-22 13:58:40	\N
117	11	7	500.00	2	12	2020-10-22 13:58:40	\N
118	8	8	500.00	2	12	2020-10-22 13:58:41	\N
119	10	9	500.00	2	12	2020-10-22 13:58:41	\N
120	17	10	500.00	2	12	2020-10-22 13:58:42	\N
121	5	1	300.00	1	13	2020-10-22 13:58:42	\N
122	5	2	300.00	1	13	2020-10-22 13:58:43	\N
123	1	3	300.00	1	13	2020-10-22 13:58:43	\N
124	5	4	300.00	1	13	2020-10-22 13:58:44	\N
125	4	5	300.00	1	13	2020-10-22 13:58:44	\N
126	16	6	500.00	2	13	2020-10-22 13:58:45	\N
127	14	7	500.00	2	13	2020-10-22 13:58:45	\N
128	14	8	500.00	2	13	2020-10-22 13:58:45	\N
129	17	9	500.00	2	13	2020-10-22 13:58:46	\N
130	17	10	500.00	2	13	2020-10-22 13:58:46	\N
131	3	1	300.00	1	14	2020-10-22 13:58:47	\N
132	1	2	300.00	1	14	2020-10-22 13:58:47	\N
133	3	3	300.00	1	14	2020-10-22 13:58:47	\N
134	5	4	300.00	1	14	2020-10-22 13:58:48	\N
135	4	5	300.00	1	14	2020-10-22 13:58:49	\N
136	11	6	500.00	2	14	2020-10-22 13:58:49	\N
137	17	7	500.00	2	14	2020-10-22 13:58:50	\N
138	10	8	500.00	2	14	2020-10-22 13:58:50	\N
139	18	9	500.00	2	14	2020-10-22 13:58:51	\N
140	12	10	500.00	2	14	2020-10-22 13:58:51	\N
141	3	1	300.00	1	15	2020-10-22 13:58:51	\N
142	5	2	300.00	1	15	2020-10-22 13:58:52	\N
143	1	3	300.00	1	15	2020-10-22 13:58:52	\N
144	2	4	300.00	1	15	2020-10-22 13:58:53	\N
145	5	5	300.00	1	15	2020-10-22 13:58:53	\N
146	15	6	500.00	2	15	2020-10-22 13:58:54	\N
147	5	7	500.00	2	15	2020-10-22 13:58:54	\N
148	9	8	500.00	2	15	2020-10-22 13:58:54	\N
149	14	9	500.00	2	15	2020-10-22 13:58:55	\N
150	12	10	500.00	2	15	2020-10-22 13:58:55	\N
151	1	1	300.00	1	16	2020-10-22 13:58:55	\N
152	3	2	300.00	1	16	2020-10-22 13:58:56	\N
153	2	3	300.00	1	16	2020-10-22 13:58:56	\N
154	4	4	300.00	1	16	2020-10-22 13:58:57	\N
155	1	5	300.00	1	16	2020-10-22 13:58:57	\N
156	18	6	500.00	2	16	2020-10-22 13:58:58	\N
157	11	7	500.00	2	16	2020-10-22 13:58:58	\N
158	15	8	500.00	2	16	2020-10-22 13:58:58	\N
159	16	9	500.00	2	16	2020-10-22 13:58:59	\N
160	9	10	500.00	2	16	2020-10-22 13:59:00	\N
161	1	1	300.00	1	17	2020-10-22 13:59:00	\N
162	4	2	300.00	1	17	2020-10-22 13:59:01	\N
163	1	3	300.00	1	17	2020-10-22 13:59:01	\N
164	5	4	300.00	1	17	2020-10-22 13:59:02	\N
165	3	5	300.00	1	17	2020-10-22 13:59:02	\N
166	10	6	500.00	2	17	2020-10-22 13:59:03	\N
167	14	7	500.00	2	17	2020-10-22 13:59:03	\N
168	6	8	500.00	2	17	2020-10-22 13:59:04	\N
169	16	9	500.00	2	17	2020-10-22 13:59:04	\N
170	8	10	500.00	2	17	2020-10-22 13:59:05	\N
171	2	1	300.00	1	18	2020-10-22 13:59:06	\N
172	3	2	300.00	1	18	2020-10-22 13:59:06	\N
173	4	3	300.00	1	18	2020-10-22 13:59:07	\N
174	2	4	300.00	1	18	2020-10-22 13:59:07	\N
175	5	5	300.00	1	18	2020-10-22 13:59:08	\N
176	9	6	500.00	2	18	2020-10-22 13:59:08	\N
177	11	7	500.00	2	18	2020-10-22 13:59:09	\N
178	5	8	500.00	2	18	2020-10-22 13:59:10	\N
179	7	9	500.00	2	18	2020-10-22 13:59:10	\N
180	20	10	500.00	2	18	2020-10-22 13:59:11	\N
181	3	1	300.00	1	19	2020-10-22 13:59:11	\N
182	2	2	300.00	1	19	2020-10-22 13:59:12	\N
183	5	3	300.00	1	19	2020-10-22 13:59:12	\N
184	3	4	300.00	1	19	2020-10-22 13:59:13	\N
185	1	5	300.00	1	19	2020-10-22 13:59:13	\N
186	10	6	500.00	2	19	2020-10-22 13:59:13	\N
187	20	7	500.00	2	19	2020-10-22 13:59:14	\N
188	13	8	500.00	2	19	2020-10-22 13:59:14	\N
189	10	9	500.00	2	19	2020-10-22 13:59:15	\N
190	15	10	500.00	2	19	2020-10-22 13:59:15	\N
191	5	1	300.00	1	20	2020-10-22 13:59:16	\N
192	5	2	300.00	1	20	2020-10-22 13:59:16	\N
193	4	3	300.00	1	20	2020-10-22 13:59:16	\N
194	1	4	300.00	1	20	2020-10-22 13:59:17	\N
195	1	5	300.00	1	20	2020-10-22 13:59:17	\N
196	6	6	500.00	2	20	2020-10-22 13:59:18	\N
197	17	7	500.00	2	20	2020-10-22 13:59:18	\N
198	15	8	500.00	2	20	2020-10-22 13:59:19	\N
199	11	9	500.00	2	20	2020-10-22 13:59:19	\N
200	10	10	500.00	2	20	2020-10-22 13:59:19	\N
\.


                                                                                                                                                                                                                                               2930.dat                                                                                            0000600 0004000 0002000 00000001506 13762305036 0014256 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        73	1	2	1	2020-11-15	2020-11-26	1650.00	2020-11-15 02:14:33	\N
74	1	182	1	2020-11-18	2020-11-26	2400.00	2020-11-15 02:35:52	\N
75	1	186	1	2020-11-18	2020-11-26	4000.00	2020-11-15 03:07:46	\N
76	1	115	1	2020-11-19	2020-11-30	3300.00	2020-11-15 03:08:22	\N
77	1	105	1	2020-11-25	2020-11-27	600.00	2020-11-15 03:22:14	\N
78	1	125	1	2020-11-25	2020-11-27	600.00	2020-11-15 03:22:51	\N
111	1	84	1	2020-11-16	2020-11-26	1500.00	2020-11-15 17:15:27	\N
112	1	19	1	2020-11-25	2020-11-30	1250.00	2020-11-17 17:34:30	\N
113	1	187	1	2020-11-22	2020-11-25	1500.00	2020-11-22 23:31:56	\N
114	1	23	1	2020-11-23	2020-11-26	450.00	2020-11-23 02:26:42	\N
115	200	106	1	2020-11-23	2020-11-27	2000.00	2020-11-23 02:32:33	\N
116	200	41	1	2020-12-20	2020-12-25	750.00	2020-11-23 20:52:42	\N
117	200	82	1	2020-11-26	2020-11-30	600.00	2020-11-25 15:51:00	\N
\.


                                                                                                                                                                                          2943.dat                                                                                            0000600 0004000 0002000 00000000215 13762305036 0014256 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	73	1	2	1	2020-11-15	2020-11-26	1650.00	2020-12-02 23:06:03.242999
2	73	1	2	1	2020-11-15	2020-11-26	1650.00	2020-12-02 23:06:16.797461
\.


                                                                                                                                                                                                                                                                                                                                                                                   2932.dat                                                                                            0000600 0004000 0002000 00000000152 13762305036 0014254 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Aguardando	2020-10-22 13:56:31	\N
2	Pago	2020-10-22 13:56:32	\N
3	Cancelado	2020-10-22 13:56:32	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                                                      2934.dat                                                                                            0000600 0004000 0002000 00000000005 13762305036 0014253 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2936.dat                                                                                            0000600 0004000 0002000 00000000105 13762305036 0014256 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Pousada	2020-10-22 13:56:27	\N
2	Hotel	2020-10-22 13:56:27	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                           2938.dat                                                                                            0000600 0004000 0002000 00000000102 13762305036 0014255 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Normal	2020-10-22 13:56:29	\N
2	VIP	2020-10-22 13:56:29	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                              2940.dat                                                                                            0000600 0004000 0002000 00000001440 13762305036 0014254 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        200	João Pedrosa	JoaoPedrosa@gmail.com	t3g9vKe2w5wIpviSWTu8HNzVpgTGyh8B7r0gtW9k65B6nO1b81	2020-10-22 14:00:12	\N
1	Natan Almeida	natanalmeidadelima@gmail.com	QwEohYaPSlDd9SuAskuAZ1knmLFdsPycxqRsSeSp9ZaMNETxNO	2020-10-26 13:24:38	\N
2	Danielle Almeida	daniellea@gmail.com	ZRR3wyQ9nta5HFwRoeyF8TSKavyPXLnJfP7bUsW5TXrromTGYp	2020-10-26 13:39:46	\N
3	maria jakeline freitas da silva	jakefreaitas@gmail.com	Lpq8qawgC3bCtynfaoMtUf2xIBAxq1nIxMQEzvRdDHVvMDf47y	2020-11-01 18:16:58	\N
4	walyson	walyson@gmail.com	pE3kZQiWWZWmqrCJx7E2VaMg0N7X9Ey1bIeMxIy62Qc5jsGIxh	2020-11-01 18:19:14	\N
5	Ciro	ciro@gmail.com	WHgw7QoINbRRqPqO0IzORhXEySbh6FOZbTjCD7KMy9QDYUjwjO	2020-11-09 17:31:18	\N
6	Natan Almeida	natanalmeidadelima2@gmail.com	fKiWXDc3JdKblkDer2DmQ7D63udILlCEv0s3WTOggOOrjPrcom	2020-11-10 21:51:54	\N
\.


                                                                                                                                                                                                                                restore.sql                                                                                         0000600 0004000 0002000 00000054152 13762305036 0015400 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE banco_wiki_integrador;
--
-- Name: banco_wiki_integrador; Type: DATABASE; Schema: -; Owner: -
--

CREATE DATABASE banco_wiki_integrador WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';


\connect banco_wiki_integrador

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: save_state_of_reservation(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.save_state_of_reservation() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
	begin
		insert into reserva_log
		(id_usuario, id_reserva, id_quarto, id_situacao_de_pagamento, data_entrada, 
		 data_saida, valor_a_pagar, updated_at) 
		values (OLD.id_usuario, OLD.id, OLD.id_quarto, OLD.id_situacao_de_pagamento,
			   OLD.data_entrada, OLD.data_saida, OLD.valor_a_pagar, now());
		return NULL;
	end
$$;


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: reserva; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.reserva (
    id bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id_quarto bigint NOT NULL,
    id_situacao_de_pagamento bigint NOT NULL,
    data_entrada date NOT NULL,
    data_saida date NOT NULL,
    valor_a_pagar numeric(8,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: save_state_of_reservation(public.reserva); Type: PROCEDURE; Schema: public; Owner: -
--

CREATE PROCEDURE public.save_state_of_reservation(reservation public.reserva)
    LANGUAGE plpgsql
    AS $$
	begin
		insert into reserva_log
		(id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, 
		 data_saida, valor_a_pagar, updated_at) 
		values (reservation.id_usuario, reservation.id_quarto, reservation.id_situacao_de_pagamento,
			   reservation.data_entrada, reservation.data_saida, reservation.valor_a_pagar, now());
	end
$$;


--
-- Name: endereco; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.endereco (
    id bigint NOT NULL,
    rua character varying(255) NOT NULL,
    numero integer NOT NULL,
    bairro character varying(55) NOT NULL,
    cidade character varying(55) NOT NULL,
    estado character varying(55) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: endereco_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.endereco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: endereco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.endereco_id_seq OWNED BY public.endereco.id;


--
-- Name: estabelecimento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.estabelecimento (
    id bigint NOT NULL,
    nome character varying(100) NOT NULL,
    id_endereco bigint NOT NULL,
    id_tipo_de_estabelecimento bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: estabelecimento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.estabelecimento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: estabelecimento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.estabelecimento_id_seq OWNED BY public.estabelecimento.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: quarto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.quarto (
    id bigint NOT NULL,
    andar integer NOT NULL,
    numero integer NOT NULL,
    valor numeric(8,2) NOT NULL,
    id_tipo_de_quarto bigint NOT NULL,
    id_estabelecimento bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: quarto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.quarto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: quarto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.quarto_id_seq OWNED BY public.quarto.id;


--
-- Name: reserva_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.reserva_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: reserva_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.reserva_id_seq OWNED BY public.reserva.id;


--
-- Name: reserva_log; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.reserva_log (
    id integer NOT NULL,
    id_reserva integer,
    id_usuario integer,
    id_quarto integer,
    id_situacao_de_pagamento integer,
    data_entrada date,
    data_saida date,
    valor_a_pagar numeric(8,2),
    updated_at timestamp without time zone
);


--
-- Name: reserva_log_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.reserva_log_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: reserva_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.reserva_log_id_seq OWNED BY public.reserva_log.id;


--
-- Name: situacao_de_pagamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.situacao_de_pagamento (
    id bigint NOT NULL,
    nome character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: situacao_de_pagamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.situacao_de_pagamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: situacao_de_pagamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.situacao_de_pagamento_id_seq OWNED BY public.situacao_de_pagamento.id;


--
-- Name: status_do_quarto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.status_do_quarto (
    id bigint NOT NULL,
    nome character varying(55) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: status_do_quarto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.status_do_quarto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: status_do_quarto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.status_do_quarto_id_seq OWNED BY public.status_do_quarto.id;


--
-- Name: tipo_de_estabelecimento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipo_de_estabelecimento (
    id bigint NOT NULL,
    nome character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: tipo_de_estabelecimento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipo_de_estabelecimento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tipo_de_estabelecimento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipo_de_estabelecimento_id_seq OWNED BY public.tipo_de_estabelecimento.id;


--
-- Name: tipo_de_quarto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipo_de_quarto (
    id bigint NOT NULL,
    nome character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: tipo_de_quarto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipo_de_quarto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tipo_de_quarto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipo_de_quarto_id_seq OWNED BY public.tipo_de_quarto.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.usuario (
    id bigint NOT NULL,
    nome character varying(100) NOT NULL,
    email character varying(255) NOT NULL,
    token character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;


--
-- Name: endereco id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco ALTER COLUMN id SET DEFAULT nextval('public.endereco_id_seq'::regclass);


--
-- Name: estabelecimento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.estabelecimento ALTER COLUMN id SET DEFAULT nextval('public.estabelecimento_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: quarto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.quarto ALTER COLUMN id SET DEFAULT nextval('public.quarto_id_seq'::regclass);


--
-- Name: reserva id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva ALTER COLUMN id SET DEFAULT nextval('public.reserva_id_seq'::regclass);


--
-- Name: reserva_log id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva_log ALTER COLUMN id SET DEFAULT nextval('public.reserva_log_id_seq'::regclass);


--
-- Name: situacao_de_pagamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.situacao_de_pagamento ALTER COLUMN id SET DEFAULT nextval('public.situacao_de_pagamento_id_seq'::regclass);


--
-- Name: status_do_quarto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.status_do_quarto ALTER COLUMN id SET DEFAULT nextval('public.status_do_quarto_id_seq'::regclass);


--
-- Name: tipo_de_estabelecimento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_de_estabelecimento ALTER COLUMN id SET DEFAULT nextval('public.tipo_de_estabelecimento_id_seq'::regclass);


--
-- Name: tipo_de_quarto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_de_quarto ALTER COLUMN id SET DEFAULT nextval('public.tipo_de_quarto_id_seq'::regclass);


--
-- Name: usuario id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);


--
-- Data for Name: endereco; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.endereco (id, rua, numero, bairro, cidade, estado, created_at, updated_at) FROM stdin;
\.
COPY public.endereco (id, rua, numero, bairro, cidade, estado, created_at, updated_at) FROM '$$PATH$$/2922.dat';

--
-- Data for Name: estabelecimento; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.estabelecimento (id, nome, id_endereco, id_tipo_de_estabelecimento, created_at, updated_at) FROM stdin;
\.
COPY public.estabelecimento (id, nome, id_endereco, id_tipo_de_estabelecimento, created_at, updated_at) FROM '$$PATH$$/2924.dat';

--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.migrations (id, migration, batch) FROM stdin;
\.
COPY public.migrations (id, migration, batch) FROM '$$PATH$$/2926.dat';

--
-- Data for Name: quarto; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.quarto (id, andar, numero, valor, id_tipo_de_quarto, id_estabelecimento, created_at, updated_at) FROM stdin;
\.
COPY public.quarto (id, andar, numero, valor, id_tipo_de_quarto, id_estabelecimento, created_at, updated_at) FROM '$$PATH$$/2928.dat';

--
-- Data for Name: reserva; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.reserva (id, id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, data_saida, valor_a_pagar, created_at, updated_at) FROM stdin;
\.
COPY public.reserva (id, id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, data_saida, valor_a_pagar, created_at, updated_at) FROM '$$PATH$$/2930.dat';

--
-- Data for Name: reserva_log; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.reserva_log (id, id_reserva, id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, data_saida, valor_a_pagar, updated_at) FROM stdin;
\.
COPY public.reserva_log (id, id_reserva, id_usuario, id_quarto, id_situacao_de_pagamento, data_entrada, data_saida, valor_a_pagar, updated_at) FROM '$$PATH$$/2943.dat';

--
-- Data for Name: situacao_de_pagamento; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.situacao_de_pagamento (id, nome, created_at, updated_at) FROM stdin;
\.
COPY public.situacao_de_pagamento (id, nome, created_at, updated_at) FROM '$$PATH$$/2932.dat';

--
-- Data for Name: status_do_quarto; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.status_do_quarto (id, nome, created_at, updated_at) FROM stdin;
\.
COPY public.status_do_quarto (id, nome, created_at, updated_at) FROM '$$PATH$$/2934.dat';

--
-- Data for Name: tipo_de_estabelecimento; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tipo_de_estabelecimento (id, nome, created_at, updated_at) FROM stdin;
\.
COPY public.tipo_de_estabelecimento (id, nome, created_at, updated_at) FROM '$$PATH$$/2936.dat';

--
-- Data for Name: tipo_de_quarto; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tipo_de_quarto (id, nome, created_at, updated_at) FROM stdin;
\.
COPY public.tipo_de_quarto (id, nome, created_at, updated_at) FROM '$$PATH$$/2938.dat';

--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.usuario (id, nome, email, token, created_at, updated_at) FROM stdin;
\.
COPY public.usuario (id, nome, email, token, created_at, updated_at) FROM '$$PATH$$/2940.dat';

--
-- Name: endereco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.endereco_id_seq', 20, true);


--
-- Name: estabelecimento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.estabelecimento_id_seq', 20, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 40, true);


--
-- Name: quarto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.quarto_id_seq', 200, true);


--
-- Name: reserva_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reserva_id_seq', 117, true);


--
-- Name: reserva_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reserva_log_id_seq', 2, true);


--
-- Name: situacao_de_pagamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.situacao_de_pagamento_id_seq', 1, false);


--
-- Name: status_do_quarto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.status_do_quarto_id_seq', 1, false);


--
-- Name: tipo_de_estabelecimento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipo_de_estabelecimento_id_seq', 1, false);


--
-- Name: tipo_de_quarto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipo_de_quarto_id_seq', 1, false);


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.usuario_id_seq', 6, true);


--
-- Name: endereco endereco_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT endereco_pkey PRIMARY KEY (id);


--
-- Name: estabelecimento estabelecimento_id_endereco_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_id_endereco_unique UNIQUE (id_endereco);


--
-- Name: estabelecimento estabelecimento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: quarto quarto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.quarto
    ADD CONSTRAINT quarto_pkey PRIMARY KEY (id);


--
-- Name: reserva reserva_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_pkey PRIMARY KEY (id);


--
-- Name: situacao_de_pagamento situacao_de_pagamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.situacao_de_pagamento
    ADD CONSTRAINT situacao_de_pagamento_pkey PRIMARY KEY (id);


--
-- Name: status_do_quarto status_do_quarto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.status_do_quarto
    ADD CONSTRAINT status_do_quarto_pkey PRIMARY KEY (id);


--
-- Name: tipo_de_estabelecimento tipo_de_estabelecimento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_de_estabelecimento
    ADD CONSTRAINT tipo_de_estabelecimento_pkey PRIMARY KEY (id);


--
-- Name: tipo_de_quarto tipo_de_quarto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_de_quarto
    ADD CONSTRAINT tipo_de_quarto_pkey PRIMARY KEY (id);


--
-- Name: usuario usuario_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_email_unique UNIQUE (email);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: reserva save_date_reservation_before_update; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER save_date_reservation_before_update BEFORE DELETE OR UPDATE ON public.reserva FOR EACH ROW EXECUTE FUNCTION public.save_state_of_reservation();


--
-- Name: estabelecimento estabelecimento_id_endereco_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_id_endereco_foreign FOREIGN KEY (id_endereco) REFERENCES public.endereco(id);


--
-- Name: estabelecimento estabelecimento_id_tipo_de_estabelecimento_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.estabelecimento
    ADD CONSTRAINT estabelecimento_id_tipo_de_estabelecimento_foreign FOREIGN KEY (id_tipo_de_estabelecimento) REFERENCES public.tipo_de_estabelecimento(id);


--
-- Name: quarto quarto_id_estabelecimento_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.quarto
    ADD CONSTRAINT quarto_id_estabelecimento_foreign FOREIGN KEY (id_estabelecimento) REFERENCES public.estabelecimento(id);


--
-- Name: quarto quarto_id_tipo_de_quarto_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.quarto
    ADD CONSTRAINT quarto_id_tipo_de_quarto_foreign FOREIGN KEY (id_tipo_de_quarto) REFERENCES public.tipo_de_quarto(id);


--
-- Name: reserva reserva_id_quarto_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_id_quarto_foreign FOREIGN KEY (id_quarto) REFERENCES public.quarto(id);


--
-- Name: reserva reserva_id_situacao_de_pagamento_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_id_situacao_de_pagamento_foreign FOREIGN KEY (id_situacao_de_pagamento) REFERENCES public.situacao_de_pagamento(id);


--
-- Name: reserva reserva_id_usuario_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES public.usuario(id);


--
-- Name: reserva_log reserva_log_id_quarto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_quarto_fkey FOREIGN KEY (id_quarto) REFERENCES public.quarto(id);


--
-- Name: reserva_log reserva_log_id_reserva_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_reserva_fkey FOREIGN KEY (id_reserva) REFERENCES public.reserva(id);


--
-- Name: reserva_log reserva_log_id_situacao_de_pagamento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_situacao_de_pagamento_fkey FOREIGN KEY (id_situacao_de_pagamento) REFERENCES public.situacao_de_pagamento(id);


--
-- Name: reserva_log reserva_log_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reserva_log
    ADD CONSTRAINT reserva_log_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id);


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      