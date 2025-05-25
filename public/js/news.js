const url = "http://floonder-api.kakashispiritnews.my.id";

// Function to fetch news
async function fetchNews() {
    try {
        const response = await fetch(url + '/api/public/news');

        // Check if the response is not ok
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }

        const newsData = await response.json();

        // Displaying news data
        displayNews(newsData);

        return newsData;
    } catch (error) {
        console.error('Error fetching news:', error);
        alert('Failed to load news data.');
    }
}

// Function to display news data
function displayNews(newsData) {
    const newsGrid = document.getElementById('news-grid');
    newsGrid.innerHTML = ''; // Clear existing content

    newsData.forEach(news => {
        const newsCard = document.createElement('div');
        newsCard.className = 'news-card';

        const newsTitle = document.createElement('h3');
        newsTitle.textContent = news.title; // Display the title

        const newsContent = document.createElement('p');
        newsContent.textContent = news.content; // Display the content

        const newsDetails = document.createElement('p');
        newsDetails.textContent = `Author: ${news.author} | Published Date: ${news.published_date}`; // Display author and date

        newsCard.appendChild(newsTitle);
        newsCard.appendChild(newsContent);
        newsCard.appendChild(newsDetails);
        newsGrid.appendChild(newsCard);
    });
}

// Call the fetchNews function
fetchNews();
