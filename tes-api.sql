PGDMP         ;            	    x            test_api    12.4    12.4                 0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16408    test_api    DATABASE     �   CREATE DATABASE test_api WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Indonesian_Indonesia.1252' LC_CTYPE = 'Indonesian_Indonesia.1252';
    DROP DATABASE test_api;
                postgres    false            �            1259    16414    tbl_data    TABLE     �   CREATE TABLE public.tbl_data (
    kode character(15) NOT NULL,
    nama character varying(50),
    desk character varying(100)
);
    DROP TABLE public.tbl_data;
       public         heap    postgres    false            �
          0    16414    tbl_data 
   TABLE DATA           4   COPY public.tbl_data (kode, nama, desk) FROM stdin;
    public          postgres    false    202   r       ~
           2606    16418    tbl_data tbl_data_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.tbl_data
    ADD CONSTRAINT tbl_data_pkey PRIMARY KEY (kode);
 @   ALTER TABLE ONLY public.tbl_data DROP CONSTRAINT tbl_data_pkey;
       public            postgres    false    202            �
   Q   x�34140B 0VPP�,�/�
)��y�
ŉ�\``� ����
����
�y��^Vb^Ib�B^bnA~NW� � 5     