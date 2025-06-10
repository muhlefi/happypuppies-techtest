import '../models/song.dart';

class SongServices {
  static final List<Song> _songs = [
    Song(id: 's1', title: 'Song A', artist: 'Artist X', genre: 'Pop'),
    Song(id: 's2', title: 'Song B', artist: 'Artist Y', genre: 'Rock'),
  ];

  Future<List<Song>> getAllSongs() async {
    return List.from(_songs);
  }

  Future<void> addSong(Song song) async {
    _songs.add(song);
  }

  Future<void> updateSong(Song updatedSong) async {
    final index = _songs.indexWhere((song) => song.id == updatedSong.id);
    if (index != -1) {
      _songs[index] = updatedSong;
    }
  }

  Future<void> deleteSong(String id) async {
    _songs.removeWhere((song) => song.id == id);
  }
}

