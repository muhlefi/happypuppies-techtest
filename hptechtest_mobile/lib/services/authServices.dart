import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import '../models/user.dart';
import '../utils/constants.dart';

class AuthServices {
  static const String _loggedInUserKey = 'loggedInUser';
  static const String _loginTimeKey = 'loginTime';

  static final List<User> _users = [
    User(username: 'admin', password: 'admin'),
  ];

  Future<bool> login(String username, String password) async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();

    User? foundUser;
    for (var user in _users) {
      if (user.username == username && user.password == password) {
        foundUser = user;
        break;
      }
    }

    if (foundUser != null) {
      await prefs.setString(_loggedInUserKey, json.encode(foundUser.toMap()));
      await prefs.setInt(_loginTimeKey, DateTime.now().millisecondsSinceEpoch);
      return true;
    }
    return false;
  }

  Future<void> logout() async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.remove(_loggedInUserKey);
    await prefs.remove(_loginTimeKey);
  }

  Future<bool> isLoggedIn() async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    final String? userJson = prefs.getString(_loggedInUserKey);
    final int? loginTime = prefs.getInt(_loginTimeKey);

    if (userJson != null && loginTime != null) {
      final int currentTime = DateTime.now().millisecondsSinceEpoch;
      final int elapsed = currentTime - loginTime;

      if (elapsed < SESSION_DURATION_MS) {
        return true;
      } else {
        await logout();
        return false;
      }
    }
    return false;
  }

  Future<String?> getCurrentUsername() async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    if (await isLoggedIn()) {
      final String? userJson = prefs.getString(_loggedInUserKey);
      if (userJson != null) {
        final Map<String, dynamic> userMap = json.decode(userJson);
        final User user = User.fromMap(userMap);
        return user.username;
      }
    }
    return null;
  }
}
