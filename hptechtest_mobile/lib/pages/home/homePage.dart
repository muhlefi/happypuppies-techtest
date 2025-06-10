import 'package:flutter/material.dart';
import '../../models/song.dart';
import '../../services/authServices.dart';
import '../../services/songServices.dart';
import '../auth/loginPage.dart';
import '../song/songFormPage.dart';
import '../../widgets/songListItem.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  String _username = 'Guest';
  List<Song> _allSongs = [];
  List<Song> _filteredSongs = [];
  String _searchQuery = '';
  String? _selectedGenreFilter;
  String _sortBy = 'title';

  final TextEditingController _searchController = TextEditingController();

  final List<String> _genres = [
    'Pop',
    'Rock',
    'Jazz',
    'Dangdut',
    'Classical',
    'Hip Hop',
    'Other',
  ];

  final AuthServices _authServices = AuthServices();
  final SongServices _songServices = SongServices();

  @override
  void initState() {
    super.initState();
    _loadUsername();
    _loadSongs();
    _searchController.addListener(_onSearchChanged);
  }

  @override
  void dispose() {
    _searchController.removeListener(_onSearchChanged);
    _searchController.dispose();
    super.dispose();
  }

  Future<void> _loadUsername() async {
    String? username = await _authServices.getCurrentUsername();
    setState(() {
      _username = username ?? 'Guest';
    });
  }

  void _logout() async {
    await _authServices.logout();
    if (!mounted) return;
    Navigator.of(context).pushReplacement(
      MaterialPageRoute(builder: (context) => const LoginPage()),
    );
  }

  Future<void> _loadSongs() async {
    final songs = await _songServices.getAllSongs();
    setState(() {
      _allSongs = songs;
      _applyFiltersAndSort();
    });
  }

  void _onSearchChanged() {
    setState(() {
      _searchQuery = _searchController.text;
      _applyFiltersAndSort();
    });
  }

  void _applyFiltersAndSort() {
    List<Song> tempSongs = List.from(_allSongs);

    if (_searchQuery.isNotEmpty) {
      tempSongs = tempSongs.where((song) {
        return song.title.toLowerCase().contains(_searchQuery.toLowerCase());
      }).toList();
    }

    if (_selectedGenreFilter != null && _selectedGenreFilter != 'All') {
      tempSongs = tempSongs.where((song) {
        return song.genre == _selectedGenreFilter;
      }).toList();
    }

    tempSongs.sort((a, b) {
      if (_sortBy == 'title') {
        return a.title.compareTo(b.title);
      } else {
        return a.artist.compareTo(b.artist);
      }
    });

    setState(() {
      _filteredSongs = tempSongs;
    });
  }

  void _navigateToSongForm({Song? song}) async {
    final result = await Navigator.of(context).push(MaterialPageRoute(builder: (context) => SongFormPage(song: song)));

    if (result == true) {
      _loadSongs();
    }
  }

  void _deleteSong(String songId) async {
    final bool? confirm = await showDialog<bool>(
      context: context,
      builder: (context) {
        return AlertDialog(
          title: const Text('Delete Song'),
          content: Text('Are you sure you want to delete "${_filteredSongs.firstWhere((song) => song.id == songId).title}"?'),
          actions: [
            TextButton(
              child: const Text('Cancel'),
              onPressed: () => Navigator.of(context).pop(false),
            ),
            TextButton(
              child: const Text('Delete'),
              onPressed: () => Navigator.of(context).pop(true),
            ),
          ],
        );
      },
    );

    if (confirm == true) {
      await _songServices.deleteSong(songId);
      _loadSongs();
      if (!mounted) return;
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Song deleted successfully!')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('HappyPuppies Test'),
        centerTitle: true,
        backgroundColor: Theme.of(context).primaryColor,
        foregroundColor: Colors.white,
        actions: [
          IconButton(
            icon: const Icon(Icons.logout),
            tooltip: 'Logout',
            onPressed: _logout,
          ),
        ],
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(12.0),
            child: TextField(
              controller: _searchController,
              decoration: const InputDecoration(
                labelText: 'Search by Title',
                hintText: 'Enter song title...',
                prefixIcon: Icon(Icons.search),
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.all(Radius.circular(10)),
                ),
                contentPadding: EdgeInsets.symmetric(
                  vertical: 16,
                  horizontal: 12,
                ),
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 12.0),
            child: Row(
              children: [
                Expanded(
                  child: DropdownButtonFormField<String>(
                    decoration: const InputDecoration(
                      labelText: 'Filter by Genre',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.all(Radius.circular(10)),
                      ),
                      contentPadding: EdgeInsets.symmetric(
                        horizontal: 12,
                        vertical: 8,
                      ),
                    ),
                    value: _selectedGenreFilter,
                    hint: const Text('All Genres'),
                    items: ['All', ..._genres].map((genre) {
                      return DropdownMenuItem<String>(
                        value: genre,
                        child: Text(genre),
                      );
                    }).toList(),
                    onChanged: (value) {
                      setState(() {
                        _selectedGenreFilter = value;
                        _applyFiltersAndSort();
                      });
                    },
                  ),
                ),
                const SizedBox(width: 10),
                Expanded(
                  child: DropdownButtonFormField<String>(
                    decoration: const InputDecoration(
                      labelText: 'Sort By',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.all(Radius.circular(10)),
                      ),
                      contentPadding: EdgeInsets.symmetric(
                        horizontal: 12,
                        vertical: 8,
                      ),
                    ),
                    value: _sortBy,
                    items: const [
                      DropdownMenuItem(value: 'title', child: Text('Title')),
                      DropdownMenuItem(value: 'artist', child: Text('Artist')),
                    ],
                    onChanged: (value) {
                      setState(() {
                        _sortBy = value!;
                        _applyFiltersAndSort();
                      });
                    },
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 10),
          Expanded(
            child: _filteredSongs.isEmpty
                ? Center(
                    child: Text(
                      _allSongs.isEmpty
                          ? 'No songs added yet. Click + to add one!'
                          : 'No matching songs found for "$_searchQuery" or selected filters.',
                      textAlign: TextAlign.center,
                      style: const TextStyle(fontSize: 16, color: Colors.grey),
                    ),
                  )
                : ListView.builder(
                    itemCount: _filteredSongs.length,
                    itemBuilder: (context, index) {
                      final song = _filteredSongs[index];
                      return SongListItem(
                        song: song,
                        onEdit: () => _navigateToSongForm(song: song),
                        onDelete: () => _deleteSong(song.id),
                      );
                    },
                  ),
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () => _navigateToSongForm(),
        tooltip: 'Add New Song',
        child: const Icon(Icons.add),
      ),
    );
  }
}
