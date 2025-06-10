class Song {
  final String id;
  final String title;
  final String artist;
  final String genre;

  Song({
    String? id,
    required this.title,
    required this.artist,
    required this.genre,
  }) : id = id ?? DateTime.now().microsecondsSinceEpoch.toString();

  Map<String, dynamic> toMap() => {
        'id': id,
        'title': title,
        'artist': artist,
        'genre': genre,
      };

  factory Song.fromMap(Map<String, dynamic> map) {
    return Song(
      id: map['id'] as String,
      title: map['title'] as String,
      artist: map['artist'] as String,
      genre: map['genre'] as String,
    );
  }

  Song copyWith({String? id, String? title, String? artist, String? genre}) {
    return Song(
      id: id ?? this.id,
      title: title ?? this.title,
      artist: artist ?? this.artist,
      genre: genre ?? this.genre,
    );
  }
}
