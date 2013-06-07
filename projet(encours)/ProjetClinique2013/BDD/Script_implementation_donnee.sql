-- Implémentation des valeurs de la relation Service :

Insert into Service values("med","medecine");
Insert into Service values("chir1","chirurgie1");
Insert into Service values("chir2","chirurgie2");
Insert into Service values("ambu","ambulatoire");

-- Implémentation des valeurs de la relation Chambre :

--  	Chambres du service medecine

Insert into Chambre values("101","med");
Insert into Chambre values("102","med");
Insert into Chambre values("103","med");
Insert into Chambre values("104","med");
Insert into Chambre values("105","med");
Insert into Chambre values("106","med");
Insert into Chambre values("107","med");
Insert into Chambre values("108","med");
Insert into Chambre values("109","med");
Insert into Chambre values("110","med");
Insert into Chambre values("111","med");
Insert into Chambre values("112","med");
Insert into Chambre values("114","med");
Insert into Chambre values("115","med");
Insert into Chambre values("116","med");
Insert into Chambre values("117","med");
Insert into Chambre values("118","med");
Insert into Chambre values("120","med");
Insert into Chambre values("122","med");
Insert into Chambre values("124","med");
Insert into Chambre values("126","med");

-- 		Chambres du service chirurgie 1

Insert into Chambre values("201","chir1");
Insert into Chambre values("202","chir1");
Insert into Chambre values("203","chir1");
Insert into Chambre values("204","chir1");
Insert into Chambre values("205","chir1");
Insert into Chambre values("206","chir1");
Insert into Chambre values("207","chir1");
Insert into Chambre values("208","chir1");
Insert into Chambre values("209","chir1");
Insert into Chambre values("210","chir1");
Insert into Chambre values("211","chir1");
Insert into Chambre values("212","chir1");
Insert into Chambre values("214","chir1");
Insert into Chambre values("215","chir1");
Insert into Chambre values("216","chir1");
Insert into Chambre values("217","chir1");
Insert into Chambre values("218","chir1");
Insert into Chambre values("220","chir1");
Insert into Chambre values("222","chir1");
Insert into Chambre values("224","chir1");
Insert into Chambre values("226","chir1");

-- 		Chambres du service chirurgie 2

Insert into Chambre values("227","chir2");
Insert into Chambre values("228","chir2");
Insert into Chambre values("229","chir2");
Insert into Chambre values("230","chir2");
Insert into Chambre values("231","chir2");
Insert into Chambre values("232","chir2");
Insert into Chambre values("233","chir2");
Insert into Chambre values("234","chir2");
Insert into Chambre values("235","chir2");
Insert into Chambre values("236","chir2");
Insert into Chambre values("237","chir2");
Insert into Chambre values("238","chir2");
Insert into Chambre values("239","chir2");
Insert into Chambre values("240","chir2");
Insert into Chambre values("241","chir2");
Insert into Chambre values("242","chir2");
Insert into Chambre values("243","chir2");
Insert into Chambre values("245","chir2");
Insert into Chambre values("247","chir2");
Insert into Chambre values("249","chir2");
Insert into Chambre values("251","chir2");

-- 		Chambres du service ambulatoire

Insert into Chambre values("A01","ambu");
Insert into Chambre values("A02","ambu");
Insert into Chambre values("A03","ambu");
Insert into Chambre values("A04","ambu");
Insert into Chambre values("A05","ambu");
Insert into Chambre values("A06","ambu");
Insert into Chambre values("A07","ambu");
Insert into Chambre values("A08","ambu");
Insert into Chambre values("A09","ambu");
Insert into Chambre values("A10","ambu");
Insert into Chambre values("A11","ambu");
Insert into Chambre values("A12","ambu");
Insert into Chambre values("A14","ambu");


-- Implémentation des valeurs de la relation lit :

--  	Lit des chambres du service medecine

Insert into Lit values("101C","101");
Insert into Lit values("101F","101");
Insert into Lit values("102C","102");
Insert into Lit values("102F","102");
Insert into Lit values("103C","103");
Insert into Lit values("103F","103");
Insert into Lit values("104","104");
Insert into Lit values("105C","105");
Insert into Lit values("105F","105");
Insert into Lit values("106","106");
Insert into Lit values("107C","107");
Insert into Lit values("107F","107");
Insert into Lit values("108","108");
Insert into Lit values("109C","109");
Insert into Lit values("109F","109");
Insert into Lit values("110","110");
Insert into Lit values("111C","111");
Insert into Lit values("111F","111");
Insert into Lit values("112","112");
Insert into Lit values("114","114");
Insert into Lit values("115C","115");
Insert into Lit values("115F","115");
Insert into Lit values("116","116");
Insert into Lit values("117C","117");
Insert into Lit values("117F","117");
Insert into Lit values("118","118");
Insert into Lit values("120","120");
Insert into Lit values("122","122");
Insert into Lit values("124","124");
Insert into Lit values("126","126");

-- 		Lit des chambres du service chirurgie 1

Insert into Lit values("201C","201");
Insert into Lit values("201F","201");
Insert into Lit values("202","202");
Insert into Lit values("203C","203");
Insert into Lit values("203F","203");
Insert into Lit values("204","204");
Insert into Lit values("205C","205");
Insert into Lit values("205F","205");
Insert into Lit values("206","206");
Insert into Lit values("207C","207");
Insert into Lit values("207F","207");
Insert into Lit values("208","208");
Insert into Lit values("209C","209");
Insert into Lit values("209F","209");
Insert into Lit values("210","210");
Insert into Lit values("211C","211");
Insert into Lit values("211F","211");
Insert into Lit values("212","212");
Insert into Lit values("214","214");
Insert into Lit values("215C","215");
Insert into Lit values("215F","215");
Insert into Lit values("216","216");
Insert into Lit values("217","217");
Insert into Lit values("218","218");
Insert into Lit values("220","220");
Insert into Lit values("222","222");
Insert into Lit values("224","224");
Insert into Lit values("226","226");

-- 		Lit des chambres du service chirurgie 2

Insert into Lit values("227","227");
Insert into Lit values("228C","228");
Insert into Lit values("228F","228");
Insert into Lit values("229","229");
Insert into Lit values("230C","230");
Insert into Lit values("230F","230");
Insert into Lit values("231","231");
Insert into Lit values("232C","232");
Insert into Lit values("232F","232");
Insert into Lit values("233","233");
Insert into Lit values("234C","234");
Insert into Lit values("234F","234");
Insert into Lit values("235","235");
Insert into Lit values("236C","236");
Insert into Lit values("236F","236");
Insert into Lit values("237","237");
Insert into Lit values("238C","238");
Insert into Lit values("238F","238");
Insert into Lit values("239","239");
Insert into Lit values("240C","240");
Insert into Lit values("240F","240");
Insert into Lit values("241","241");
Insert into Lit values("242C","242");
Insert into Lit values("242F","242");
Insert into Lit values("243","243");
Insert into Lit values("245","245");
Insert into Lit values("247","247");
Insert into Lit values("249","249");
Insert into Lit values("251","251");

-- 		Lit des chambres du service ambulatoire

Insert into Lit values("A01","A01");
Insert into Lit values("A02","A02");
Insert into Lit values("A03","A03");
Insert into Lit values("A04","A04");
Insert into Lit values("A05C","A05");
Insert into Lit values("A05F","A05");
Insert into Lit values("A06","A06");
Insert into Lit values("A07C","A07");
Insert into Lit values("A07F","A07");
Insert into Lit values("A08C","A08");
Insert into Lit values("A08F","A08");
Insert into Lit values("A09C","A09");
Insert into Lit values("A09F","A09");
Insert into Lit values("A10C","A10");
Insert into Lit values("A10F","A10");
Insert into Lit values("A11C","A11");
Insert into Lit values("A11F","A11");
Insert into Lit values("A12C","A12");
Insert into Lit values("A12F","A12");
Insert into Lit values("A14C","A14");
Insert into Lit values("A14F","A14");

-- Implémentation des valeurs de la relation TypeQuestionnaire :

Insert into TypeQuestionnaire values("ambu","questionnaire ambulatoire");
Insert into TypeQuestionnaire values("repas","questionnaire repas");
Insert into TypeQuestionnaire values("hospi","questionnaire hospitalisation");

-- Implémentation des valeurs de la relation Partie :

-- 		questionnaire de satisfaction de l'ambulatoire

Insert into Partie values("1","I. ACCES A LA POLYCLINIQUE","ambu");
Insert into Partie values("2","II. STANDARD TELEPHONIQUE","ambu");
Insert into Partie values("3","III. PRISE EN CHARGE ADMINISTRATIVE","ambu");
Insert into Partie values("4","IV. HOTELLERIE / RESTAURATION","ambu");
Insert into Partie values("5","V. PRISE EN CHARGE MEDICALE","ambu");
Insert into Partie values("6","LES EQUIPES DE SOINS","ambu");
Insert into Partie values("7","LES MEDECINS","ambu");
Insert into Partie values("8","BRANCARDAGE","ambu");
Insert into Partie values("9","BLOC OPERATOIRE / RADIOLOGIE","ambu");
Insert into Partie values("10","PRISE EN CHARGE DE LA DOULEUR","ambu");
Insert into Partie values("11","VI. VOTRE SORTIE","ambu");
Insert into Partie values("12","VII. APPRECIATION GENERALE","ambu");

-- 		questionnaire de satisfaction de restauration
Insert into Partie values("1","Information sur votre regime","repas");
Insert into Partie values("2","Le déjeuner / Le diner","repas");
Insert into Partie values("3","De façon générale","repas");

-- 		questionnaire de satisfaction de l'hospitalisation

Insert into Partie values("1","I. ACCES A LA POLYCLINIQUE","hospi");
Insert into Partie values("2","II. STANDARD TELEPHONIQUE","hospi");
Insert into Partie values("3","III. PRISE EN CHARGE ADMINISTRATIVE","hospi");
Insert into Partie values("4","IV. HOTELLERIE / RESTAURATION","hospi");
Insert into Partie values("5"," HEBERGEMENT","hospi");
Insert into Partie values("6","RESTAURATION","hospi");
Insert into Partie values("7","V. PRISE EN CHARGE MEDICALE","hospi");
Insert into Partie values("8","LES EQUIPES DE SOINS","hospi");
Insert into Partie values("9","LES MEDECINS","hospi");
Insert into Partie values("10","BRANCARDAGE","hospi");
Insert into Partie values("11","BLOC OPERATOIRE / RADIOLOGIE","hospi");
Insert into Partie values("12","PRISE EN CHARGE DE LA DOULEUR","hospi");
Insert into Partie values("13","VI. VOTRE SORTIE","hospi");
Insert into Partie values("14","VII. APPRECIATION GENERALE","hospi");

-- Implémentation des valeurs de la relation ContenuPartie :

-- 		questionnaire de satisfaction de l'ambulatoire

Insert into ContenuPartie values("1","ambu","1","Facilité d'accès et de stationnement");
Insert into ContenuPartie values("1","ambu","2","Signalisation intérieure");
Insert into ContenuPartie values("1","ambu","3","Qualité du site internet ([url]www.clinalpsud.com[/url])");

Insert into ContenuPartie values("2","ambu","1","Délai d'attente");
Insert into ContenuPartie values("2","ambu","2","Qualité des informations transmises");

Insert into ContenuPartie values("3","ambu","1","Qualité de l'accueil");
Insert into ContenuPartie values("3","ambu","2","Respect de la confidentialité");
Insert into ContenuPartie values("3","ambu","3","Délai d'attente pour établir votre dossier");
Insert into ContenuPartie values("3","ambu","4","Qualité des informations données (heure d'arrivée, tarifs …)");
Insert into ContenuPartie values("3","ambu","5","Qualité du livret d'accueil");

Insert into ContenuPartie values("4","ambu","1","Votre chambre (confort, propreté, calme...)");
Insert into ContenuPartie values("4","ambu","2","Votre collation (qualité, quantité…)");

Insert into ContenuPartie values("6","ambu","1","Disponibilité / Amabilité");
Insert into ContenuPartie values("6","ambu","2","Respect de l'intimité et de la confidentialité");
Insert into ContenuPartie values("6","ambu","3","Qualité des informations et des soins donnés");
Insert into ContenuPartie values("6","ambu","4","Présentation et identification du personnel");
Insert into ContenuPartie values("6","ambu","5","Accueil réservé à vos proches");

Insert into ContenuPartie values("7","ambu","1","Disponibilité / Amabilité");
Insert into ContenuPartie values("7","ambu","2","Respect de l'intimité et de la confidentialité");
Insert into ContenuPartie values("7","ambu","3","Qualité des informations et des soins donnés");

Insert into ContenuPartie values("8","ambu","1","Amabilité");
Insert into ContenuPartie values("8","ambu","2","Respect de l'intimité et de la confidentialité");
Insert into ContenuPartie values("8","ambu","3","Sécurité");

Insert into ContenuPartie values("9","ambu","1","Qualité de l'accueil");
Insert into ContenuPartie values("9","ambu","2","Délai d'attente à l'entrée");
Insert into ContenuPartie values("9","ambu","3","Respect de l'intimité et de la confidentialité");

Insert into ContenuPartie values("10","ambu","1","Qualité de la prise en charge");
Insert into ContenuPartie values("10","ambu","2","Avez-vous souffert ?");
Insert into ContenuPartie values("10","ambu","3","Si oui, en avez-vous averti le personnel soignant ?");
Insert into ContenuPartie values("10","ambu","4","A-t-on répondu à votre demande ?");

Insert into ContenuPartie values("11","ambu","1","Délai d'attente (formalités administratives)");

Insert into ContenuPartie values("12","ambu","1","Qualité du séjour");
Insert into ContenuPartie values("12","ambu","2","Recommanderiez-vous la polyclinique à l'un de vos proches ?");
Insert into ContenuPartie values("12","ambu","3","Remarques / Suggestions :");

-- 		questionnaire de satisfaction de restauration

Insert into ContenuPartie values("1","repas","1","Etes-vous soumis à un régime alimentaire particulier?");
Insert into ContenuPartie values("1","repas","2","Si oui, le régime prescrit est-il toujours respecté ?");

Insert into ContenuPartie values("2","repas","1","Le goût des entrées");
Insert into ContenuPartie values("2","repas","2","Le goût des desserts");
Insert into ContenuPartie values("2","repas","3","Le goût du plat principal");
Insert into ContenuPartie values("2","repas","4","Les sauces d'accompagnement");
Insert into ContenuPartie values("2","repas","5","La température des plats chauds");
Insert into ContenuPartie values("2","repas","6","Les quantités servies");
Insert into ContenuPartie values("2","repas","7","L'équilibre du menu");
Insert into ContenuPartie values("2","repas","8","La présentation des plats");
Insert into ContenuPartie values("2","repas","9","La présentation des plateaux");
Insert into ContenuPartie values("2","repas","10","La propreté de la vaisselle");

Insert into ContenuPartie values("3","repas","1","Le petit-déjeuner");
Insert into ContenuPartie values("3","repas","2","Le déjeuner");
Insert into ContenuPartie values("3","repas","3","Le diner");
Insert into ContenuPartie values("3","repas","4","<b>La restauration en général</b>");
Insert into ContenuPartie values("3","repas","5","Le respect des horaires des repas");
Insert into ContenuPartie values("3","repas","6","La présentation du personnel de service");
Insert into ContenuPartie values("3","repas","7","L'amabilité du personnel de service");
Insert into ContenuPartie values("3","repas","8","La disponibilité du personnel de service");
Insert into ContenuPartie values("3","repas","9","Remarques / Suggestions :");

-- 		questionnaire de satisfaction de l'hospitalisation

Insert into ContenuPartie values("1","hospi","1","Facilité d'accès et de stationnement");
Insert into ContenuPartie values("1","hospi","2","Signalisation intérieure");
Insert into ContenuPartie values("1","hospi","3","Qualité du site internet");
Insert into ContenuPartie values("1","hospi","4","Remarques / Suggestions :");

Insert into ContenuPartie values("2","hospi","1","Délai d'attente");
Insert into ContenuPartie values("2","hospi","2","Qualité des informations transmises");
Insert into ContenuPartie values("2","hospi","3","Remarques / Suggestions :");

Insert into ContenuPartie values("3","hospi","1","Qualité de l'accueil");
Insert into ContenuPartie values("3","hospi","2","Respect de la confidentialité");
Insert into ContenuPartie values("3","hospi","3","Délai d'attente pour établir votre dossier");
Insert into ContenuPartie values("3","hospi","4","Qualité des informations données (jour & heure d'arrivée, documents à apporter, tarifs appliqués…)");
Insert into ContenuPartie values("3","hospi","5","Qualité du livret d'accueil");
Insert into ContenuPartie values("3","hospi","6","Remarques / Suggestions :");

Insert into ContenuPartie values("4","hospi","1","Chambre (confort, télévision, téléphone…)");
Insert into ContenuPartie values("4","hospi","2","Propreté de la chambre");
Insert into ContenuPartie values("4","hospi","3","Calme");
Insert into ContenuPartie values("4","hospi","4","Avez-vous obtenu une chambre particulière (si vous en avez fait la demande) ?");
Insert into ContenuPartie values("4","hospi","5","Remarques / Suggestions :");

Insert into ContenuPartie values("5","hospi","1","Qualité des repas");
Insert into ContenuPartie values("5","hospi","2","Quantité des repas");
Insert into ContenuPartie values("5","hospi","3","Horaire des repas");
Insert into ContenuPartie values("5","hospi","4","Présentation des plateaux");
Insert into ContenuPartie values("5","hospi","5","Température des plats");
Insert into ContenuPartie values("5","hospi","7","Remarques / Suggestions :");

Insert into ContenuPartie values("6","hospi","1","Disponibilité / Amabilité");
Insert into ContenuPartie values("6","hospi","2","Respect de l'intimité et de la confidentialité");
Insert into ContenuPartie values("6","hospi","3","Qualité des informations et des soins donnés");
Insert into ContenuPartie values("6","hospi","4","Présentation et identification du personnel");
Insert into ContenuPartie values("6","hospi","5","Accueil réservé à vos proches");
Insert into ContenuPartie values("6","hospi","6","Remarques / Suggestions :");

Insert into ContenuPartie values("7","hospi","1","Disponibilité / Amabilité");
Insert into ContenuPartie values("7","hospi","2","Respect de l'intimité et de la confidentialité");
Insert into ContenuPartie values("7","hospi","3","Qualité des informations et des soins donnés");
Insert into ContenuPartie values("7","hospi","4","Remarques / Suggestions :");

Insert into ContenuPartie values("8","hospi","1","Amabilité");
Insert into ContenuPartie values("8","hospi","2","Respect de l'intimité et de la confidentialité");
Insert into ContenuPartie values("8","hospi","3","Sécurité");
Insert into ContenuPartie values("8","hospi","4","Remarques / Suggestions :");

Insert into ContenuPartie values("9","hospi","1","Qualité de l'accueil");
Insert into ContenuPartie values("9","hospi","2","Délai d'attente à l'entrée");
Insert into ContenuPartie values("9","hospi","3","Respect de l'intimité et de la confidentialité");
Insert into ContenuPartie values("9","hospi","4","Remarques / Suggestions :");

Insert into ContenuPartie values("10","hospi","1","Qualité de la prise en charge");
Insert into ContenuPartie values("10","hospi","2","Avez-vous souffert ?");
Insert into ContenuPartie values("10","hospi","3","Si oui, en avez-vous averti le personnel soignant ?");
Insert into ContenuPartie values("10","hospi","4","A-t-on répondu à votre demande ?");
Insert into ContenuPartie values("10","hospi","5","Remarques / Suggestions :");

Insert into ContenuPartie values("11","hospi","1","Délai d'attente (formalités administratives)");
Insert into ContenuPartie values("11","hospi","2","Information sur le devenir personnel");
Insert into ContenuPartie values("11","hospi","3","Remarques / Suggestions :");

Insert into ContenuPartie values("12","hospi","1","Qualité du séjour");
Insert into ContenuPartie values("12","hospi","2","Recommanderiez-vous la polyclinique à l'un de vos proches ?");
Insert into ContenuPartie values("12","hospi","3","Remarques / Suggestions :");

Insert into ContenuPartie values("13","hospi","1","Qualité du Délai d'attente (formalités administratives)");
Insert into ContenuPartie values("13","hospi","2","Information sur le devenir personnel");
Insert into ContenuPartie values("13","hospi","3","Remarques / Suggestions :");

Insert into ContenuPartie values("14","hospi","1","Qualité du séjour");
Insert into ContenuPartie values("14","hospi","2","Recommanderiez-vous la polyclinique à l'un de vos proches ?");
Insert into ContenuPartie values("14","hospi","3","Remarques / Suggestions :");