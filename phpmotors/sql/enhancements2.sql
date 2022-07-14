INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", 1, "I am the real Ironman");

UPDATE clients 
SET clientLevel = "3"
WHERE clientFirstname = "Tony";

UPDATE inventory
SET    invDescription = REPLACE( invDescription, 'small interiors', 'spacious interior ' )
WHERE invModel = "Hummer";


SELECT invModel
FROM inventory
INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationName = "SUV";

DELETE FROM inventory 
WHERE invId=1;

UPDATE inventory
SET invImage=CONCAT('/phpmotors' , invImage), invThumbnail=CONCAT('/phpmotors' , invThumbnail);
