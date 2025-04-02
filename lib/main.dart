import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter API Demo',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        useMaterial3: true,
      ),
      home: const HomePage(),
    );
  }
}

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<dynamic> _usuarios = [];
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _fetchUsuarios();
  }

  Future<void> _fetchUsuarios() async {
    const String apiUrl = 'http://localhost:3000/api/usuarios/listar';
    
    try {
      final response = await http.get(Uri.parse(apiUrl));

      if (response.statusCode == 200) {
        setState(() {
          _usuarios = json.decode(response.body);
          _isLoading = false;
        });
      } else {
        throw Exception("Error al cargar los usuarios");
      }
    } catch (error) {
      print("Error: $error");
      setState(() {
        _isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Lista de Usuarios")),
      body: _isLoading
          ? const Center(child: CircularProgressIndicator())
          : _usuarios.isEmpty
              ? const Center(child: Text("No hay usuarios disponibles"))
              : ListView.builder(
                  itemCount: _usuarios.length,
                  itemBuilder: (context, index) {
                    final usuario = _usuarios[index];
                    return ListTile(
                      title: Text(usuario['nombre']),
                      subtitle: Text(usuario['correo']),
                      leading: const Icon(Icons.person),
                    );
                  },
                ),
    );
  }
}
