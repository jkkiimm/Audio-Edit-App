# AudioMax
AudioMax allows you to download YouTube or Soundcloud videos as mp3s on the server and allows the user to edit the song for experimentation.

## Dependencies

1. PHP
2. MySQL

## Setup

1. Create api.js file for YouTube API key.

### Create api.js file for YouTube API key.

You must create api.js file in the root of this git repo. The api.js format will be:

```
var api = {
	"key": "YOUTUBE_API_KEY"
}
```