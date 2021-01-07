import pandas
import json
import io
import requests
from datetime import datetime

current_date = datetime.today().strftime('%Y-%m-%d')

response = requests.post(
            'https://accounts.spotify.com/api/token',
            data={'grant_type': 'client_credentials'},
            headers={
                'Authorization': 'Basic token'}
        )

json_response = json.loads(response.content.decode('utf-8'))
token_spotify = json_response['access_token']

json_login = {
    "username":"sample@example00.com",
    "password":"password"
}

response = requests.post('http://localhost/api/login_check', json=json_login)
json_response = response.json()
token = json_response['token']

response = requests.get(
                'http://localhost/api/charts?platformMusicId=/api/platform_musics/2',
                headers={'Authorization': 'Bearer ' + token}
            )
json_response = response.json()
charts_spotify = json_response['hydra:member']

for chart in charts_spotify:
    country_id = chart['countryId'][-2:]
    urlSpotify = "https://spotifycharts.com/regional/" + country_id + "/weekly/latest/download"
    csv = requests.get(urlSpotify).content
    c = pandas.read_csv(io.StringIO(csv.decode('utf-8')), skiprows=2, usecols=[1, 0, 2, 4, 3],
                        names=['position', 'trackName', 'artist', 'stream', 'link'])
    data = c.to_dict(orient='records')
    for song in data:
        isrc = 'null'
        title = song['trackName']
        artist = song['artist']
        id_spotify = song['link'][-22:]
        response = requests.get(
            'https://api.spotify.com/v1/tracks/' + id_spotify,
            headers={'Authorization': 'Bearer ' + token_spotify}
        )
        json_response = response.json()
        cover = json_response['album']['images'][0]['url']
        if 'external_ids' in json_response:
            if 'isrc' in json_response['external_ids']:
                isrc = json_response['external_ids']['isrc']

        response = requests.get(
            f'http://localhost/api/tracks?isrc={isrc}',
            headers={'Authorization': 'Bearer ' + token}
        )
        result_search_isrc = response.json()

        if result_search_isrc["hydra:totalItems"] == 0:
            json_new_track = {"title": title, "isrc": isrc, 'cover': cover}
            response = requests.post(
                f'http://localhost/api/tracks?isrc={isrc}',
                headers={'Authorization': 'Bearer ' + token},
                json=json_new_track
            )
            new_track_database = response.json()
            id_track = new_track_database["@id"]

            response = requests.get(
                f'http://localhost/api/artists?name={artist}',
                headers={'Authorization': 'Bearer ' + token}
            )
            result_search_artist = response.json()
            if result_search_artist["hydra:totalItems"] == 0:
                json_new_artist = {"name": artist}
                response = requests.post(
                    f'http://localhost/api/artists',
                    headers={'Authorization': 'Bearer ' + token},
                    json=json_new_artist
                )
                new_artist_database = response.json()
                id_artist = new_artist_database['@id']
            else:
                id_artist = result_search_artist['hydra:member'][0]['@id']

            json_new_sing = {"trackId": id_track, "artistId": id_artist, "role": 0}
            response = requests.post(
                'http://localhost/api/sings',
                headers={'Authorization': 'Bearer ' + token},
                json=json_new_sing
            )
            new_sings_database = response.json()
        else:
            id_track = result_search_isrc['hydra:member'][0]['@id']

        json_new_track_chart = {"trackId": id_track, "chartId": chart['@id'], "position": song['position'], "publicationDate": current_date}
        response = requests.post(
            'http://localhost/api/tracks_charts',
            headers={'Authorization': 'Bearer ' + token},
            json=json_new_track_chart
        )
        new_track_chart = response.json()
        print(new_track_chart)















