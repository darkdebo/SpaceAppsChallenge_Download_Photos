# SpaceAppsChallenge_Download_Photos
NASA SpaceAppsChallenge 2018. Download photos with their description using the NASA api. 

I created this project for a challenge over a weekend.

NASA organizes a hackathon every year in different parts of the world and makes available to the participants real data about space, Earth, etc.

Our project consisted of uploading any photo to our application and forming a mosaic with the shape of that photo using thousands of NASA images.

This part of the project connects with the NASA API to download images of Planet Earth, saves them on disk and also saves in a MySql database information about the image such as: the photographer, the name, the description etc.

It also has a part where you resize each of the images to leave them in the same proportions.

# Download json with images and some data

Use the file "index.php" with three different params:
- searchWord: type of images that we can download
- resultType: option [image,audio,video]
- page: number of page of results

Example:
http://localhost/api_fotos_nasa/index.php?searchWord=mars&resultType=image&page=4

# Save images in disk and info in MySql database

Use the file "saveImagesLocally.php" no params because they are into the code

Example:
http://localhost/api_fotos_nasa/saveImagesLocally.php

# Resize images to 300x300 px

Use the file "changeImageSize.php"

No params. This process read all images in the database that not processed and update it

Example:
http://localhost/api_fotos_nasa/changeImageSize.php
