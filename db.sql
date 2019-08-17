--
-- PostgreSQL database dump
--

-- Dumped from database version 11.4
-- Dumped by pg_dump version 11.4

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
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Booking; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Booking" (
    booking_id integer NOT NULL,
    user_id integer NOT NULL,
    truck_id integer NOT NULL,
    initial_loc character varying(150),
    final_loc character varying(150),
    eta character varying(30),
    dep_time character varying(150),
    arr_time character varying(150),
    distance character varying(50),
    fare double precision
);


ALTER TABLE public."Booking" OWNER TO postgres;

--
-- Name: TABLE "Booking"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Booking" IS 'A table which contains all booking info of users';


--
-- Name: Booking_booking_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Booking_booking_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Booking_booking_id_seq" OWNER TO postgres;

--
-- Name: Booking_booking_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Booking_booking_id_seq" OWNED BY public."Booking".booking_id;


--
-- Name: Credit_Cards; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Credit_Cards" (
    card_id integer NOT NULL,
    user_id integer NOT NULL,
    card_number character varying(16) NOT NULL,
    month integer NOT NULL,
    year integer NOT NULL,
    cvv integer NOT NULL,
    balance double precision NOT NULL,
    full_name character varying(150) NOT NULL
);


ALTER TABLE public."Credit_Cards" OWNER TO postgres;

--
-- Name: TABLE "Credit_Cards"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Credit_Cards" IS 'A table to store all Credit card info of users';


--
-- Name: Credit_Cards_card_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Credit_Cards_card_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Credit_Cards_card_id_seq" OWNER TO postgres;

--
-- Name: Credit_Cards_card_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Credit_Cards_card_id_seq" OWNED BY public."Credit_Cards".card_id;


--
-- Name: Goods; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Goods" (
    goods_id integer NOT NULL,
    name character varying(30) NOT NULL,
    category character varying(30),
    weight integer,
    image character varying(1000),
    price_factor double precision,
    description character varying(200) DEFAULT 'No description'::character varying
);


ALTER TABLE public."Goods" OWNER TO postgres;

--
-- Name: TABLE "Goods"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Goods" IS 'Table for all goods of Truck It Easy';


--
-- Name: Goods_Booking; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Goods_Booking" (
    goods_id integer NOT NULL,
    booking_id integer NOT NULL,
    quantity integer
);


ALTER TABLE public."Goods_Booking" OWNER TO postgres;

--
-- Name: TABLE "Goods_Booking"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Goods_Booking" IS 'A table for mapping booking and goods m:n relationship';


--
-- Name: Goods_goods_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Goods_goods_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Goods_goods_id_seq" OWNER TO postgres;

--
-- Name: Goods_goods_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Goods_goods_id_seq" OWNED BY public."Goods".goods_id;


--
-- Name: Payment; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Payment" (
    payment_id integer NOT NULL,
    booking_id integer NOT NULL,
    user_id integer NOT NULL,
    amount double precision NOT NULL,
    card_number character(16) NOT NULL,
    month integer NOT NULL,
    year integer NOT NULL,
    cvv integer NOT NULL,
    full_name character(150) NOT NULL
);


ALTER TABLE public."Payment" OWNER TO postgres;

--
-- Name: TABLE "Payment"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Payment" IS 'A table to store all payments of bookings done by users';


--
-- Name: Payment_payment_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Payment_payment_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Payment_payment_id_seq" OWNER TO postgres;

--
-- Name: Payment_payment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Payment_payment_id_seq" OWNED BY public."Payment".payment_id;


--
-- Name: Services; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Services" (
    service_id integer NOT NULL,
    name character varying(50) NOT NULL,
    contact character varying(10),
    rating integer,
    description character varying DEFAULT 'No description'::character varying,
    image character varying(1000)
);


ALTER TABLE public."Services" OWNER TO postgres;

--
-- Name: TABLE "Services"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Services" IS 'A table for all Services hosted by Truck It Easy';


--
-- Name: Services_service_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Services_service_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Services_service_id_seq" OWNER TO postgres;

--
-- Name: Services_service_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Services_service_id_seq" OWNED BY public."Services".service_id;


--
-- Name: Trucks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Trucks" (
    truck_id integer NOT NULL,
    name character varying(30) NOT NULL,
    capacity integer,
    d_name character varying(30),
    d_contact character varying(10),
    image character varying(100),
    price_factor double precision,
    user_id integer,
    service_id integer,
    description character varying(500) DEFAULT 'No description'::character varying
);


ALTER TABLE public."Trucks" OWNER TO postgres;

--
-- Name: TABLE "Trucks"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Trucks" IS 'Table for all trucks of Truck It Easy';


--
-- Name: Truckss_truck_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Truckss_truck_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Truckss_truck_id_seq" OWNER TO postgres;

--
-- Name: Truckss_truck_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Truckss_truck_id_seq" OWNED BY public."Trucks".truck_id;


--
-- Name: Users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Users" (
    name character varying(30) NOT NULL,
    contact character varying(10) NOT NULL,
    email character varying(50) NOT NULL,
    age integer NOT NULL,
    location character varying(30) NOT NULL,
    password character varying(20) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public."Users" OWNER TO postgres;

--
-- Name: TABLE "Users"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Users" IS 'The database for Users of Truck It Easy
';


--
-- Name: Users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Users_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Users_id_seq" OWNER TO postgres;

--
-- Name: Users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Users_id_seq" OWNED BY public."Users".id;


--
-- Name: Booking booking_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Booking" ALTER COLUMN booking_id SET DEFAULT nextval('public."Booking_booking_id_seq"'::regclass);


--
-- Name: Credit_Cards card_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Credit_Cards" ALTER COLUMN card_id SET DEFAULT nextval('public."Credit_Cards_card_id_seq"'::regclass);


--
-- Name: Goods goods_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Goods" ALTER COLUMN goods_id SET DEFAULT nextval('public."Goods_goods_id_seq"'::regclass);


--
-- Name: Payment payment_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Payment" ALTER COLUMN payment_id SET DEFAULT nextval('public."Payment_payment_id_seq"'::regclass);


--
-- Name: Services service_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Services" ALTER COLUMN service_id SET DEFAULT nextval('public."Services_service_id_seq"'::regclass);


--
-- Name: Trucks truck_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Trucks" ALTER COLUMN truck_id SET DEFAULT nextval('public."Truckss_truck_id_seq"'::regclass);


--
-- Name: Users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Users" ALTER COLUMN id SET DEFAULT nextval('public."Users_id_seq"'::regclass);


--
-- Data for Name: Booking; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Booking" (booking_id, user_id, truck_id, initial_loc, final_loc, eta, dep_time, arr_time, distance, fare) FROM stdin;
55	15	3	Surat, Gujarat, India	Dhule, Maharashtra, India	5 hours 2 mins	Sat Aug 17 2019 23:48:56 GMT+0530 (India Standard Time)	Sun Aug 18 2019 04:50:56 GMT+0530 (India Standard Time)	240 km	2904
57	12	4	Pune, Maharashtra, India	Latur, Maharashtra, India	6 hours 20 mins	Sun Aug 18 2019 01:00:30 GMT+0530 (India Standard Time)	Sun Aug 18 2019 07:20:30 GMT+0530 (India Standard Time)	328 km	426.399999999999977
50	12	4	Surat, Gujarat, India	Aurangabad, Maharashtra, India	8 hours 15 mins	Sat Aug 17 2019 23:29:50 GMT+0530 (India Standard Time)	Sun Aug 18 2019 07:44:50 GMT+0530 (India Standard Time)	379 km	5343.89999999999964
\.


--
-- Data for Name: Credit_Cards; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Credit_Cards" (card_id, user_id, card_number, month, year, cvv, balance, full_name) FROM stdin;
2	15	2222333344445555	7	2022	111	72096	Harshil Patel
3	12	0000111122223333	12	2039	222	2500	Karan Sheth
1	12	1111222233334444	2	2023	235	8953.89999999999964	Vignesh V
\.


--
-- Data for Name: Goods; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Goods" (goods_id, name, category, weight, image, price_factor, description) FROM stdin;
1	Table Fan	Electronics	30	https://images-na.ssl-images-amazon.com/images/I/71Lp7KG%2BKtL._SL1200_.jpg	0.599999999999999978	No description
2	Fan	Electronics	60	https://www.bajajelectricals.com/media/3549/fan.jpg	2	No description
9	Shoe Rack	Furniture	31	https://4.imimg.com/data4/AI/WX/ANDROID-8829356/product-500x500.jpeg	3.20000000000000018	A sturdy shoe rack
8	Chair	Furniture	25	https://secure.img1-fg.wfcdn.com/im/70710600/resize-h600-w600%5Ecompr-r85/1784/17840401/Kitchen+%26+Dining+Chairs.jpg	0.599999999999999978	This is a chair
7	Fridge	Electronics	65	https://images.homedepot-static.com/productImages/cc115637-8405-4a3a-b390-127951ccad8f/svn/stainless-look-magic-chef-mini-fridges-hmdr450se-64_1000.jpg	0.299999999999999989	A cool fridge
5	Wardrobe	Furniture	85	https://ksassets.timeincuk.net/wp/uploads/sites/56/2017/06/Argos.jpg	6.29999999999999982	A good quality wardrobe
4	Large box	Other	500	https://www.movingboxdelivery.com/pub/media/catalog/product/cache/f073062f50e48eb0f0998593e568d857/l/a/large-moving-boxes-1800_2.jpg	0.200000000000000011	No description
3	Television	Electronics	50	https://d3nevzfk7ii3be.cloudfront.net/igi/CQerEFCURNsA2Iwj.large	3	No description
6	Tomato	Vegatable	2	https://images-na.ssl-images-amazon.com/images/I/71NqxXA1bZL._SX425_.jpg	0.100000000000000006	Why is this here?
10	Blackboard	Classroom	23	https://www.drawingtutorials101.com/drawing-tutorials/Others/Everyday-Objects/blackboard/how-to-draw-Blackboard-step-0.png	2.5	Classroom blackboard
\.


--
-- Data for Name: Goods_Booking; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Goods_Booking" (goods_id, booking_id, quantity) FROM stdin;
2	50	6
4	50	10
1	55	6
3	55	2
4	57	6
\.


--
-- Data for Name: Payment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Payment" (payment_id, booking_id, user_id, amount, card_number, month, year, cvv, full_name) FROM stdin;
11	50	12	5343.89999999999964	1111222233334444	2	2023	235	Vignesh V                                                                                                                                             
12	55	15	2904	2222333344445555	7	2022	111	Harshil Patel                                                                                                                                         
13	57	12	426.399999999999977	1111222233334444	2	2023	235	Vignesh V                                                                                                                                             
\.


--
-- Data for Name: Services; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Services" (service_id, name, contact, rating, description, image) FROM stdin;
1	Mahesh Services	9855633212	6	No description	https://logos.textgiraffe.com/logos/logo-name/Mahesh-designstyle-smoothie-m.png
3	Suresh Service	8556321245	8	No description	https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQpVSYSXkJlyLisYXrMAJ3WsbKsW35Re7NlNv45n23WcExjJRE
4	Lokesh service	9855633212	1	KL Rahul	https://logos.textgiraffe.com/logos/logo-name/Lokesh-designstyle-summer-m.png
\.


--
-- Data for Name: Trucks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Trucks" (truck_id, name, capacity, d_name, d_contact, image, price_factor, user_id, service_id, description) FROM stdin;
3	my truck	2533	somone	9833711084	\N	2.5	\N	\N	No description
1	truckas	2555	Soham	987754623	\N	50.2000000000000028	\N	\N	No description
4	Small truk	1	Small man	8555632134	\N	0.100000000000000006	\N	\N	A very bad truck
5	Good truck	250	Good man	5566556655	\N	3.60000000000000009	\N	\N	A good truck
\.


--
-- Data for Name: Users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Users" (name, contact, email, age, location, password, id) FROM stdin;
Vignesh V	9167309967	vignesh@gmail.com	19	Mulund, Mumbai	vtg@2000	1
VISWANATHAN RAJAGOPALAN	9833711237	vishuraj27@gmail.com	23	Thane	vtg2000	2
VISWANATHAN 	9833711238	vishuraj@gmail.com	29	Kalwa	vtg2000	3
SEEMA VISWANATHAN	9833711084	seemav@gmail.com	45	Bhandup	seemav	4
Vignesh Viswanathan	9167309968	vigneshvisw@gmail.com	19	Mulund W	vtg@2000	12
Harshil	9833711084	harshil@gmail.com	23	Bhandup	harshil	15
Harshil	9833711084	harshil@gmail.come	23	Bhandup	harshil	17
Harshil	9833711084	harshil@gmail.comes	23	Bhandup	harshil	20
GOKUL	9833711084	gokul@gmail.com	23	Thane	gokul	21
\.


--
-- Name: Booking_booking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Booking_booking_id_seq"', 57, true);


--
-- Name: Credit_Cards_card_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Credit_Cards_card_id_seq"', 3, true);


--
-- Name: Goods_goods_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Goods_goods_id_seq"', 18, true);


--
-- Name: Payment_payment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Payment_payment_id_seq"', 13, true);


--
-- Name: Services_service_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Services_service_id_seq"', 4, true);


--
-- Name: Truckss_truck_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Truckss_truck_id_seq"', 5, true);


--
-- Name: Users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Users_id_seq"', 21, true);


--
-- Name: Booking Booking_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Booking"
    ADD CONSTRAINT "Booking_pkey" PRIMARY KEY (booking_id);


--
-- Name: Booking Booking_user_id_truck_id_initial_loc_final_loc_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Booking"
    ADD CONSTRAINT "Booking_user_id_truck_id_initial_loc_final_loc_key" UNIQUE (user_id, truck_id, initial_loc, final_loc);


--
-- Name: Credit_Cards Credit_Cards_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Credit_Cards"
    ADD CONSTRAINT "Credit_Cards_pkey" PRIMARY KEY (card_id);


--
-- Name: Goods Goods_goods_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Goods"
    ADD CONSTRAINT "Goods_goods_id_key" UNIQUE (goods_id);


--
-- Name: Goods Goods_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Goods"
    ADD CONSTRAINT "Goods_name_key" UNIQUE (name);


--
-- Name: Payment Payment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Payment"
    ADD CONSTRAINT "Payment_pkey" PRIMARY KEY (payment_id);


--
-- Name: Services Services_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Services"
    ADD CONSTRAINT "Services_name_key" UNIQUE (name);


--
-- Name: Services Services_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Services"
    ADD CONSTRAINT "Services_pkey" PRIMARY KEY (service_id);


--
-- Name: Users Smart Goods System_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Users"
    ADD CONSTRAINT "Smart Goods System_email_key" UNIQUE (email);


--
-- Name: Trucks Truckss_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Trucks"
    ADD CONSTRAINT "Truckss_name_key" UNIQUE (name);


--
-- Name: Trucks Truckss_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Trucks"
    ADD CONSTRAINT "Truckss_pkey" PRIMARY KEY (truck_id);


--
-- Name: Trucks Truckss_service_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Trucks"
    ADD CONSTRAINT "Truckss_service_id_key" UNIQUE (service_id);


--
-- Name: Users Users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Users"
    ADD CONSTRAINT "Users_pkey" PRIMARY KEY (id);


--
-- Name: Booking Booking_truck_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Booking"
    ADD CONSTRAINT "Booking_truck_id_fkey" FOREIGN KEY (truck_id) REFERENCES public."Trucks"(truck_id);


--
-- Name: Booking Booking_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Booking"
    ADD CONSTRAINT "Booking_user_id_fkey" FOREIGN KEY (user_id) REFERENCES public."Users"(id);


--
-- Name: Credit_Cards Credit_Cards_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Credit_Cards"
    ADD CONSTRAINT "Credit_Cards_user_id_fkey" FOREIGN KEY (user_id) REFERENCES public."Users"(id);


--
-- Name: Goods_Booking Goods_Booking_booking_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Goods_Booking"
    ADD CONSTRAINT "Goods_Booking_booking_id_fkey" FOREIGN KEY (booking_id) REFERENCES public."Booking"(booking_id) ON DELETE CASCADE;


--
-- Name: Goods_Booking Goods_Booking_goods_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Goods_Booking"
    ADD CONSTRAINT "Goods_Booking_goods_id_fkey" FOREIGN KEY (goods_id) REFERENCES public."Goods"(goods_id);


--
-- Name: Payment Payment_booking_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Payment"
    ADD CONSTRAINT "Payment_booking_id_fkey" FOREIGN KEY (booking_id) REFERENCES public."Booking"(booking_id) ON DELETE CASCADE;


--
-- Name: Payment Payment_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Payment"
    ADD CONSTRAINT "Payment_user_id_fkey" FOREIGN KEY (user_id) REFERENCES public."Users"(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON SCHEMA public TO vtg WITH GRANT OPTION;


--
-- PostgreSQL database dump complete
--

