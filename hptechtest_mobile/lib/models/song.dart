class Song {
  final int? id;
  final String title;
  final String artist;
  final String genre;

  Song({this.id, required this.title, required this.artist, required this.genre});

  Map<String, dynamic> toMap() {
    return {
      'id': id,
      'title': title,
      'artist': artist,
      'genre': genre,
    };
  }

  factory Song.fromMap(Map<String, dynamic> map) {
    return Song(
      id: map['id'],
      title: map['title'],
      artist: map['artist'],
      genre: map['genre'],
    );
  }
}
