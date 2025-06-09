import 'package:flutter/material.dart';
import 'pages/song_list_page.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Aplikasi Lagu',
      theme: ThemeData(primarySwatch: Colors.blue),
      home: const SongListPage(),
    );
  }
}
