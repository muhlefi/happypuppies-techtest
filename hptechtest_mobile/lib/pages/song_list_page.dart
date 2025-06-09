import 'package:flutter/material.dart';
import '../models/song.dart';
import '../services/database_helper.dart';

class SongListPage extends StatefulWidget {
  const SongListPage({super.key});

  @override
  State<SongListPage> createState() => _SongListPageState();
}

class _SongListPageState extends State<SongListPage> {
  final db = DatabaseHelper();
  late Future<List<Song>> _songsFuture;

  @override
  void initState() {
    super.initState();
    _refreshSongs();
  }

  void _refreshSongs() {
    setState(() {
      _songsFuture = db.getSongs();
    });
  }

  Future<void> _addDummySong() async {
    await db.insertSong(Song(title: "Lagu Baru", artist: "Artis A", genre: "Pop"));
    _refreshSongs();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Daftar Lagu")),
      body: FutureBuilder<List<Song>>(
        future: _songsFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text("Error: ${snapshot.error}"));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text("Belum ada lagu."));
          }

          final songs = snapshot.data!;
          return ListView.builder(
            itemCount: songs.length,
            itemBuilder: (context, index) {
              final song = songs[index];
              return ListTile(
                title: Text(song.title),
                subtitle: Text("${song.artist} - ${song.genre}"),
                trailing: IconButton(
                  icon: const Icon(Icons.delete),
                  onPressed: () async {
                    await db.deleteSong(song.id!);
                    _refreshSongs();
                  },
                ),
              );
            },
          );
        },
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: _addDummySong,
        child: const Icon(Icons.add),
      ),
    );
  }
}
