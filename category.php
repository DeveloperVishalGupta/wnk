<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Playlist</title>
    <link rel="stylesheet" href="./assets/css/home.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .playlist-container {
        width: 90%;
        max-width: 800px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 8px rgb(0 0 0 / 36%);
        border-radius: 12px;
    }

    h2 {
        color: #333;
        margin-bottom: 10px;
        font-weight: 700
    }

    .playlist-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        /* border-bottom: 4px solid #eee; */
        border: 2px solid #d3d3d3;
        margin-bottom: .5rem;
        border-radius: .5rem;
        border-bottom: 3px solid #d3d3d3;
    }

    .playlist-item:hover {

        background: #0000000d;
    }

    .left-content {
        display: flex;
        align-items: center;
    }

    .coverer {
        position: relative;
        margin-right: 10px;
        cursor: pointer;
    }

    .coverer img {
        width: 50px;
        height: 50px;
        border-radius: 4px;
    }

    .play-button {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        border-radius: 4px;
        transition: opacity 0.3s;
    }

    .coverer:hover .play-button {
        opacity: 1;
    }

    .play-button i {
        color: #fff;
        font-size: 20px;
    }

    .right-content i {
        color: #ccc;
        cursor: pointer;
    }

    .right-content i:hover {
        color: #ff5252;
    }

    audio {
        display: none;
    }

    .category-list {
        margin-top: 20px;
    }

    .category-item {
        cursor: pointer;
        color: #007BFF;
        margin-bottom: 10px;
    }

    .category-item:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <!-- header  -->
    <?php include_once("header.php") ?>
    <div class="playlist-container" id="playlist"></div>
    <div class="category-list d-flex flex-wrap justify-content-around" id="category-list"></div>

    <script>
    // Fetch the JSON data from the data.json file
    fetch('data.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(playlistData => {
            const playlistContainer = document.getElementById("playlist");
            const categoryList = document.getElementById("category-list");

            // Get the category ID from the URL (assuming it's passed as a query parameter, e.g., ?id=1)
            const urlParams = new URLSearchParams(window.location.search);
            const categoryId = parseInt(urlParams.get('id'));

            // Filter categories to find the one matching the ID
            const matchedCategory = playlistData.categories.find(category => category.id === categoryId);
            const otherCategories = playlistData.categories.filter(category => category.id !== categoryId);

            // Display songs from the matched category if it exists
            if (matchedCategory) {
                const categoryHeading = document.createElement("h2");
                categoryHeading.textContent = matchedCategory.name;
                playlistContainer.appendChild(categoryHeading);

                matchedCategory.songs.forEach((item, index) => {
                    console.log(item);

                    const playlistItem = document.createElement("div");
                    playlistItem.className = "playlist-item";

                    // Create audio element with controls
                    const audio = document.createElement("audio");
                    audio.className = "audio-control";
                    audio.controls = true;
                    audio.src = item.src;

                    // Set the inner HTML of playlistItem
                    playlistItem.innerHTML = `
                            <div class="left-content">
                                <div style="margin-right:4px;width:36px;text-align:center">${index + 1}</div>
                                <div class="coverer">
                                    <img src="${item.image}" alt="${item.title}">
                                    <div class="play-button">
                                        <i class="fas fa-play" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div>
                                    <div>Song: ${item.title}</div>
                                    <p>Author: ${item.author}</p>
                                </div>
                            </div>
                            <div class="right-content">
                                <i class="far fa-heart"></i>
                            </div>
                        `;

                    // Append the audio element to the playlist item
                    playlistItem.appendChild(audio);

                    // Event listeners for play/pause functionality
                    const playButton = playlistItem.querySelector('.play-button i');

                    playlistItem.querySelector('.coverer').addEventListener('click', () => {
                        if (audio.paused) {
                            audio.play();
                            playButton.classList.replace('fa-play', 'fa-pause');
                        } else {
                            audio.pause();
                            playButton.classList.replace('fa-pause', 'fa-play');
                        }

                        // Pause any other audio playing
                        document.querySelectorAll('.audio-control').forEach(otherAudio => {
                            if (otherAudio !== audio) {
                                otherAudio.pause();
                                otherAudio.parentElement.querySelector('.play-button i')
                                    .classList.replace('fa-pause', 'fa-play');
                            }
                        });
                    });

                    // Change icon when the audio is paused or ended
                    audio.addEventListener('pause', () => {
                        playButton.classList.replace('fa-pause', 'fa-play');
                    });

                    audio.addEventListener('play', () => {
                        playButton.classList.replace('fa-play', 'fa-pause');
                    });

                    playlistContainer.appendChild(playlistItem);
                });
            } else {
                const noCategoryMessage = document.createElement("h2");
                noCategoryMessage.textContent = "No category found!";
                playlistContainer.appendChild(noCategoryMessage);
            }

            // Display other categories below
            // otherCategories.forEach(category => {
            //     console.log(category);

            //     const categoryItem = document.createElement("div");
            //     categoryItem.className = "category-item";
            //     // categoryItem.textContent = category.name;
            //     categoryItem.textContent = `
            //     <div class='aTag'  style='text-decoration:none;width:200px:'> 
            //         <div class='songCategoryCard'>
            //         <h1 id='main-title' class='songCategoryTitle'>${category.name}</h1>
            //         <div id='track-info' class='songCategoryImage'>
            //         <img class='w-100 h-100' src='${category.coverImage}'/>
            //      </div>
            //         </div> 
            //         </div> 
            //     `;
            //     categoryItem.addEventListener('click', () => {
            //         window.location.href =
            //             `?id=${category.id}`; // Change the URL to the selected category
            //     });

            //     categoryList.appendChild(categoryItem);
            // });

            otherCategories.forEach(category => {
                console.log(category);

                const categoryItem = document.createElement("div");
                categoryItem.className = "category-item d-inline-block";

                // Set the inner HTML for categoryItem
                categoryItem.innerHTML = `
        <a class='aTag' style='text-decoration:none;color:black;  cursor:pointer;'> 
            <div class='songCategoryCard'>
                <h1 id='main-title' class='songCategoryTitle'>${category.name}</h1>
                <div id='track-info' class='songCategoryImage'>
                    <img class='w-100 h-100' src='${category.coverImage}' alt='${category.name}'/>
                </div>
            </div> 
        </a> 
    `;

                // Add click event listener to redirect to the selected category
                categoryItem.addEventListener('click', () => {
                    window.location.href =
                        `?id=${category.id}`; // Change the URL to the selected category
                });

                categoryList.appendChild(categoryItem);
            });

        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    </script>
</body>

</html>