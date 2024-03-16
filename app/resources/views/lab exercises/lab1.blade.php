<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhleboLab | Laboratory Exercise 1</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);
        body {
            background-color: whitesmoke;
            font-family: "Roboto", sans-serif;
            margin: 0;
        }

        .main-content {
            display: flex;
            
        }

        .container {
            margin-left: 300px;
            flex: 1;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-wrap: wrap; 
        }

        .content {
            margin: 10px; 
            text-align: left;
            flex: 1; 
            max-width: 100%; 
            
        }

        .welcome-message {
            font-size: 36px;
            margin-bottom: -20px; 
        }

        .subtitle {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; 
        }

        .shelf {
            margin-bottom: 10px;
            width: calc(25% - 20px); 
            border: 20px solid #727272; 
            box-sizing: border-box;
            overflow: hidden; 
            position: relative; 
            cursor: pointer; 
        }

        .shelf:hover::after { 
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1;
            transition: opacity 0.3s ease; 
            opacity: 0; 
        }

        .shelf:hover::before { 
            content: 'Click to view description';
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 18px;
            z-index: 2;
            transition: opacity 0.3s ease; 
            opacity: 0; 
        }

        .shelf:hover::after,
        .shelf:hover::before { /* Added */
            opacity: 1; /* Show on hover */
        }

        .shelf img {
            width: 100%; 
            height: 300px; 
            display: block; 
        }

        .popup-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: none; /* Initially hidden */
        }

        .blur-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px); /* Added */
            z-index: 9998; /* Lower than popup */
            display: none; /* Initially hidden */
        }

        .popup-button {
            background-color: #2d4789;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkmark-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: green; /* Color of the checkmark */
            z-index: 2;
            display: none;
        }

        @media screen and (max-width: 768px) {
            .main-content {
                flex-direction: column; 
                margin-left: 0;
            }

            .container {
                margin-left: 0; 
            }

            .shelf {
                width: calc(50% - 20px); 
            }
        }
    </style>
</head>
<body>
    @include('sidebar')  
    <div class="main-content">   
        <div class="container">
            <div class="content">
                <div class="welcome-message">
                    <h2>Equipment Familiarization</h2>
                </div>
                <div class="subtitle">
                    In this laboratory exercise, you will familiarize yourself with various medical equipment used in phlebotomy procedures.<br><br>
                    <button id="practiceButton" class="popup-button" onclick="goNext()">
                        PRACTICE QUIZ&nbsp; 
                        <span id="indicator" style="color: red;"><i class="fas fa-times"></i></span>
                    </button> <span id="note" style="font-size: 14px; color: #555;"> &nbsp;Note: The practice quiz will become accessible once you've checked all the equipment.</span>
                    <br>
                </div>
                

                <div class="grid">
                    <div class="shelf" id="collectionTray" onclick="showPopup('It is a shallow container used to hold various phlebotomy equipment such as needles, syringes, evacuated tubes, alcohol pads, and other accessories during blood collection procedures. It serves as a convenient and organized workstation for phlebotomists, allowing them to have easy access to essential tools while minimizing the risk of contamination and needlestick injuries. Collection trays are typically made of durable plastic or stainless steel and may feature compartments or dividers for better organization of supplies.', 'Collection Tray', 'collectionTray')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/collection tray.png" alt="Equipment 1">
                    </div>
                    <div class="shelf" id="tourniquet" onclick="showPopup('It is a constricting or compressing device used to control arterial and venous blood flow to a portion of an extremity for a period of time. It is commonly used during medical procedures such as phlebotomy to temporarily occlude blood vessels, facilitating easier vein visualization and venipuncture. Tourniquets are typically made of latex-free materials and feature a quick-release mechanism to ensure safe and efficient application and removal.', 'Tourniquet', 'tourniquet')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/tourniquet.png" alt="Equipment 2">
                    </div>
                    <div class="shelf" id="alcoholPads" onclick="showPopup('These are pre-packaged, disposable wipes soaked in isopropyl alcohol. They are used to clean the skin before venipuncture to reduce the risk of contamination and infection. Alcohol pads effectively disinfect the puncture site by killing bacteria and other microorganisms present on the skin surface. Phlebotomists typically use alcohol pads to cleanse the venipuncture site thoroughly, ensuring a sterile environment for blood collection.', 'Acohol Pads/Swabs', 'alcoholPads')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/alcohol pads swabs.png" alt="Equipment 3">
                    </div>
                    <div class="shelf" id="sharpsContainer" onclick="showPopup('The sharps container is a puncture-resistant container designed for the safe disposal of needles, syringes, lancets, and other sharp objects used in medical procedures. These containers are specifically engineered to prevent accidental needlestick injuries and minimize the risk of exposure to bloodborne pathogens. On the other hand, biohazard sharps containers are typically made of durable plastic and feature a secure lid to seal the contents safely. They are color-coded with a bright red or orange label to indicate their biohazardous nature.', 'Sharps Containers and Biohazard Sharps Container', 'sharpsContainer')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/biohazard sharps container.png" alt="Equipment 4">
                    </div>
                    <div class="shelf" id="gloves" onclick="showPopup('These are worn by healthcare professionals during phlebotomy procedures to protect both the patient and the phlebotomist from the risk of infection. These gloves are made of latex, nitrile, or vinyl and provide a barrier against blood, bodily fluids, and other contaminants. Disposable gloves come in various sizes to ensure a comfortable and secure fit for the wearer. They are single-use items and should be discarded after each patient encounter to prevent cross-contamination.', 'Disposable Gloves', 'gloves')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/disposable gloves.png" alt="Equipment 5">
                    </div>
                    <div class="shelf" id="transferDevice" onclick="showPopup('It is a specialized tool used to safely transfer blood or other bodily fluids from one container to another without spillage or contamination. These devices are commonly used in laboratory settings to aliquot blood specimens into smaller tubes for further analysis or storage. Transfer devices may include pipettes, transfer pipettes, or transfer pipetting systems, depending on the volume and precision required for the transfer process. They are designed to ensure accurate and efficient sample handling while minimizing the risk of sample loss or contamination.', 'Transfer Device', 'transferDevice')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/transfer device.png" alt="Equipment 6">
                    </div>
                    <div class="shelf" id="syringe" onclick="showPopup('It is a calibrated glass or plastic tube with a plunger at one end. It is used to draw blood or administer medication during medical procedures. Syringes come in various sizes and are available with different types of tips, including Luer-lock and slip-tip designs. Phlebotomists use syringes with attached needles for venipuncture, blood collection, and specimen transfer. Syringes are essential tools in healthcare settings for accurate dosage measurement and precise fluid delivery.', 'Syringe', 'syringe')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/syringe.png" alt="Equipment 7">
                    </div>
                    <div class="shelf" id="needles" onclick="showPopup('The needle used on the syringe consists of a hub, cannula (shaft), and point cut at a precise bevel. The hub of the needle attaches to the syringe. The recommended length of the needle is 1 inch to 1½ in. The gauge of the needle is determined by the diameter of the lumen, or the opening at the bevel end. The gauges of needles used in health care are 27, 25, 23, 22, 21, 20, 18, and 16 (from smallest to largest). The 22-, 21-, and 20-gauge needles are used for venipuncture. The 22-gauge needle is used for small veins and for pediatric patients. A 23-gauge needle can be used in combination with a butterfly collection set. A 25-gauge needle cannot be used for venipuncture, because the red blood cells would be destroyed when the blood is pulled through the bore of the needle. The 27-gauge needle is used for administration of a purified protein derivative (PPD) tuberculosis skin test. The 25-gauge needle is used for intermuscular injections. The 18- and 16-gauge needles are used for the intravenous (IV) infusion of fluids or blood products or the removal of blood during the donor process.', 'Disposable Needles', 'needles')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/disposable needles.png" alt="Equipment 8">
                    </div>
                    <div class="shelf" id="tubes" onclick="showPopup('Each of these contain a vacuum with a rubber stopper sealing the tube. These tubes range in volume from 2 to 15 mL. The tubes have sterile interiors to prevent contamination of the sample and the patient. A sterile tube does not contaminate the blood, so any backflow of blood is inconsequential. The tubes are glass or plastic and vary in length from 65 to 127 mm with an external diameter of 10, 13, or 16 mm.', 'Evacuated Tubes', 'tubes')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/evacuated tubes.png" alt="Equipment 9">
                    </div>
                    <div class="shelf" id="gauze" onclick="showPopup('These are used to apply pressure to the venipuncture site after blood collection to prevent bleeding and promote clotting. These sterile dressings are made of absorbent cotton fibers and are designed to absorb excess blood and fluid from the puncture site. Gauze pads are typically folded into squares or rectangles, while cotton balls are soft, spherical masses of cotton. Phlebotomists use gauze or cotton balls in conjunction with adhesive bandages to secure the puncture site and provide comfort to the patient.', 'Gauze or Cotton balls', 'gauze')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/gauze or cotton balls.png" alt="Equipment 10">
                    </div>
                    <div class="shelf" id="bandages" onclick="showPopup('These are used to secure gauze or cotton balls over the venipuncture site and protect it from external contamination. These flexible strips of adhesive material adhere to the skin to hold dressings in place and provide a barrier against dirt, germs, and moisture. Adhesive bandages come in various sizes and shapes, including rectangular, oval, and butterfly designs, to accommodate different wound sizes and locations. They are easy to apply and remove, making them ideal for securing dressings after blood collection procedures.', 'Adhesive Bandages/Tape', 'bandages')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/adhesive bandages or tape.png" alt="Equipment 11">
                    </div>
                    <div class="shelf" id="safetyGear" onclick="showPopup('They are worn by healthcare professionals during phlebotomy procedures to protect the eyes and face from exposure to bloodborne pathogens and other hazardous materials. Safety glasses provide impact protection and shield the eyes from splashes, sprays, and airborne contaminants. The mask covers the nose and mouth, reducing the risk of inhaling infectious droplets or aerosols during blood collection. Safety glasses and masks are essential personal protective equipment (PPE) that help prevent occupational exposure and ensure the safety of healthcare workers and patients alike.', 'Safety Glass and a Mask', 'safetyGear')">
                        <div class="checkmark-overlay"></div> 
                        <img src="assets/images/equipment/safety glasses and a mask.png" alt="Equipment 12">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup container -->
    <div class="popup-container" id="popupContainer">
        <button onclick="closePopup()" style="position: absolute; top: 10px; right: 10px; background-color: #25396d; color: white;">X</button>
        <h3 id="popupHeading"></h3>
        <p id="popupDescription"></p>
    </div>

    <div class="blur-background" id="blurBackground"></div>

    <script>
        let indicator = document.getElementById('indicator');
        practiceButton.disabled = true;
        indicator.innerHTML = '<i class="fas fa-times"></i>'; 

        let equipmentViewed = {
            'collectionTray': false,
            'tourniquet': false,
            'alcoholPads': false,
            'sharpsContainer': false,
            'gloves': false,
            'transferDevice': false,
            'syringe': false,
            'needles': false,
            'tubes': false,
            'gauze': false,
            'bandages': false,
            'safetyGear': false,
        };

        function showPopup(description, heading, shelfId) {
            document.getElementById('popupDescription').innerText = description;
            document.getElementById('popupHeading').innerText = heading;
            document.getElementById('popupContainer').style.display = 'block';
            document.getElementById('blurBackground').style.display = 'block';
            
            const equipmentId = shelfId.replace(/\s+/g, ''); 
            equipmentViewed[equipmentId] = true;
            
            checkAllViewed();

            const checkmarkOverlay = document.getElementById(shelfId).querySelector('.checkmark-overlay');
            checkmarkOverlay.style.display = 'block';
            checkmarkOverlay.innerHTML = '<i class="fas fa-check"></i>'; 

            

            console.log('Equipment viewed:', equipmentId);
        }

        function checkAllViewed() {
            let allViewed = Object.values(equipmentViewed).every(viewed => viewed);
            if (allViewed) {
                document.getElementById('practiceButton').disabled = false;
                indicator.innerHTML = '<i class="fas fa-check" style="color: green;"></i>';
            }
        }

        function closePopup() {
            document.getElementById('popupContainer').style.display = 'none';
            document.getElementById('blurBackground').style.display = 'none';
        }

        function goNext() {
            alert('Proceeding to the practice quiz for Equipment Familiarization topic. Ensure that you have read the description of each and every equipment.');
            window.location.href = "{{ route('exercise_1_quiz') }}";
        }
    </script>
</body>
</html>
