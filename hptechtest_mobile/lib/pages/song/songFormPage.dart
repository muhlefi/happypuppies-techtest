import 'package:flutter/material.dart';
import '../../models/song.dart';
import '../../services/songServices.dart';

class SongFormPage extends StatefulWidget {
  final Song? song;

  const SongFormPage({super.key, this.song});

  @override
  State<SongFormPage> createState() => _SongFormPageState();
}

class _SongFormPageState extends State<SongFormPage> {
  final _formKey = GlobalKey<FormState>();
  final _titleController = TextEditingController();
  final _artistController = TextEditingController();
  String? _selectedGenre;

  final List<String> _genres = [
    'Pop',
    'Rock',
    'Jazz',
    'Dangdut',
    'Classical',
    'Hip Hop',
    'Other',
  ];

  final SongServices _songServices = SongServices();

  bool get _isEditing => widget.song != null;

  @override
  void initState() {
    super.initState();
    if (_isEditing) {
      _titleController.text = widget.song!.title;
      _artistController.text = widget.song!.artist;
      _selectedGenre = widget.song!.genre;
    } else {
      _selectedGenre = _genres.first;
    }
  }

  @override
  void dispose() {
    _titleController.dispose();
    _artistController.dispose();
    super.dispose();
  }

  void _saveSong() async {
    if (_formKey.currentState!.validate()) {
      final newSong = Song(
        id: _isEditing ? widget.song!.id : null,
        title: _titleController.text,
        artist: _artistController.text,
        genre: _selectedGenre!,
      );

      if (_isEditing) {
        await _songServices.updateSong(newSong);
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Song updated successfully!')),
        );
      } else {
        await _songServices.addSong(newSong);
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Song added successfully!')),
        );
      }
      Navigator.of(context).pop(true);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(_isEditing ? 'Edit Song' : 'Add New Song'),
        centerTitle: true,
        backgroundColor: Theme.of(context).primaryColor,
        foregroundColor: Colors.white,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24.0),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              TextFormField(
                controller: _titleController,
                decoration: const InputDecoration(
                  labelText: 'Song Title',
                  hintText: 'Enter song title (e.g., Bohemian Rhapsody)',
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.all(Radius.circular(10)),
                  ),
                  prefixIcon: Icon(Icons.music_note),
                  contentPadding: EdgeInsets.symmetric(
                    vertical: 16,
                    horizontal: 12,
                  ),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Song title cannot be empty';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 20),

              TextFormField(
                controller: _artistController,
                decoration: const InputDecoration(
                  labelText: 'Artist',
                  hintText: 'Enter artist name (e.g., Queen)',
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.all(Radius.circular(10)),
                  ),
                  prefixIcon: Icon(Icons.person),
                  contentPadding: EdgeInsets.symmetric(
                    vertical: 16,
                    horizontal: 12,
                  ),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Artist name cannot be empty';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 20),

              DropdownButtonFormField<String>(
                value: _selectedGenre,
                decoration: const InputDecoration(
                  labelText: 'Genre',
                  hintText: 'Select genre',
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.all(Radius.circular(10)),
                  ),
                  prefixIcon: Icon(Icons.category),
                  contentPadding: EdgeInsets.symmetric(
                    horizontal: 12,
                  ),
                ),
                items: _genres.map((genre) {
                  return DropdownMenuItem<String>(
                    value: genre,
                    child: Text(genre),
                  );
                }).toList(),
                onChanged: (value) {
                  setState(() {
                    _selectedGenre = value;
                  });
                },
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please select a genre';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 30),

              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: _saveSong,
                  style: ElevatedButton.styleFrom(
                    padding: const EdgeInsets.symmetric(vertical: 16),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(10),
                    ),
                    backgroundColor: Theme.of(context).primaryColor,
                    foregroundColor: Colors.white,
                    elevation: 5,
                  ),
                  child: Text(
                    _isEditing ? 'UPDATE SONG' : 'ADD SONG',
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
