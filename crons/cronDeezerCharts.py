import time
import requests
from datetime import datetime

current_date = datetime.today().strftime('%Y-%m-%d')


pays_lists = {'fr': '1109890291', 'us': '1313621735', 'uk': '1111142221', 'global': '3155776842',
              'de': '1111143121', 'be': '1266968331', 'ua': '1362526495', 'pt': '1362519755',
              'at': '1313615765', 'au': '1313616925', 'es': '1116190041', 'it': '1116187241',
              'ch': '1313617925', 'se': '1313620305', 'br': '1111141961', 'ca': '1652248171',
              'hr': '1266971131', 'dk': '1313618905', 'fi': '1221034071', 'gr': '1221034071',
              'hu': '1362506695', 'ie': '1313619455', 'il': '1362507345', 'no': '1313619885',
              'nl': '1266971851', 'cl': '1111141961', 'co': '1116188451', 'kr': '1362510315',
              'ee': '1221037201', 'gt': '1279118671'}


json_login = {
    "username": "username",
    "password": "password"
}

response = requests.post('http://localhost/api/login_check', json=json_login)
json_response = response.json()
token = json_response['token']

response = requests.get(
                'http://localhost/api/charts?platformMusicId=/api/platform_musics/2',
                headers={'Authorization': 'Bearer ' + token}
            )
json_response = response.json()
charts_deezer = json_response['hydra:member']


for chart in charts_deezer:
    country_id = chart['countryId'][-2:]
    id_playlist = pays_lists[country_id]
    urlDeezer = "https://api.deezer.com/playlist/" + id_playlist
    response = requests.get(urlDeezer)
    content = response.json()
    time.sleep(0.08)
    position = 1
    for track in content['tracks']['data']:
        id_track_deezer = str(track['id'])
        response = requests.get(f'https://api.deezer.com/track/{id_track_deezer}')
        time.sleep(0.1)
        while response.status_code != 200:
            response = requests.get(f'https://api.deezer.com/track/{id_track_deezer}')
            time.sleep(0.1)
        track_info_deezer = response.json()
        title = track['title']
        artist = track['artist']['name']
        isrc = track_info_deezer['isrc']
        cover = track['album']['cover_big']

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

        json_new_track_chart = {"trackId": id_track, "chartId": chart['@id'], "position": position,
                                "publicationDate": current_date}
        response = requests.post(
            'http://localhost/api/tracks_charts',
            headers={'Authorization': 'Bearer ' + token},
            json=json_new_track_chart
        )
        new_track_chart = response.json()
        print(new_track_chart)
        position += 1