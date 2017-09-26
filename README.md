# Tweet Reach

Know the reach of any tweet by calculating the follower of each retweeter. 

## Technical notes

Some limitations on this functionality:

1 - Due to twitter API, I can only get at least 100 retweeters, so if the tweet has more, the calcualted reach won't show a real value.

(a) https://twittercommunity.com/t/how-can-i-get-all-retweets-of-a-specific-tweet/11602

(b) https://dev.twitter.com/rest/reference/get/statuses/retweeters/ids

2 - In order to test, you need to create an APP in twitter, and set the correct values in the .env file.

3 - The app makes use of Cache, so you need to define a cache storage. The migrations for the DB one are already created, so if you want to
use that one, you just need to run migrations.

4 - All assets are created and ready for production, so just serve the project with Laravel Valet or with Artisan and the project should
work out of the box.