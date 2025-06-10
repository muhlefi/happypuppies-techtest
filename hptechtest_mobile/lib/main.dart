import 'package:flutter/material.dart';
import 'package:hptechtest_mobile/pages/auth/loginPage.dart';
import 'package:hptechtest_mobile/pages/home/homePage.dart';
import 'package:hptechtest_mobile/services/authServices.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  bool isLoggedIn = await AuthServices().isLoggedIn();
  runApp(MyApp(isLoggedIn: isLoggedIn));
}

class MyApp extends StatelessWidget {
  final bool isLoggedIn;
  const MyApp({Key? key, required this.isLoggedIn}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Happy Puppies App',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: isLoggedIn ? const HomePage() : const LoginPage(),
    );
  }
}
