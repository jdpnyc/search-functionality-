$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_search_database";const { MongoClient } = require('mongodb');

// Replace this with your actual connection string
const uri = "mongodb://atlas-sql-670c28a471b1856baf52fb65-qwdor.a.query.mongodb.net/sample_mflix?ssl=true&authSource=admin";

const client = new MongoClient(uri);

async function main() {
    try {
        await client.connect();
        console.log("Connected successfully to server");
        
        const database = client.db('sample_mflix');
        const collection = database.collection('movies'); // Assuming you're searching movies

        // Basic search function
        async function searchMovies(searchTerm) {
            const query = { $text: { $search: searchTerm } };
            const result = await collection.find(query).toArray();
            return result;
        }

        // Test the search
        const searchResults = await searchMovies("Inception");
        console.log(searchResults);

    } finally {
        await client.close();
    }
}

main().catch(console.error);
