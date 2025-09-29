// Copyright 2018, the Flutter project authors. Please see the AUTHORS file
// for details. All rights reserved. Use of this source code is governed by a
// BSD-style license that can be found in the LICENSE file.

import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';

void main() {
  runApp(const PlatformView());
}

class PlatformView extends StatelessWidget {
  const PlatformView({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Platform View',
      theme: ThemeData(primarySwatch: Colors.grey),
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
  static const MethodChannel _methodChannel = MethodChannel(
    'dev.flutter.sample/platform_view_swift',
  );

  int _counter = 0;

  Future<void> _launchPlatformCount() async {
    final platformCounter = await _methodChannel.invokeMethod<int>(
      'switchView',
      _counter,
    );
    setState(() => _counter = platformCounter ?? 0);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Página Inicial')),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            child: Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    'Botão pressionado $_counter vez${_counter == 1 ? '' : 'es'}.',
                    style: Theme.of(context).textTheme.titleSmall,
                  ),
                ],
              ),
            ),
          ),
          Container(
            padding: const EdgeInsets.only(bottom: 15, left: 5),
            child: Row(
              children: [
                const FlutterLogo(),
                Text(
                  'Atividade Clone Flutter',
                  style: Theme.of(context).textTheme.headlineSmall,
                ),
              ],
            ),
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () => setState(() => _counter++),
        tooltip: 'Incrementar',
        child: const Icon(Icons.add),
      ),
    );
  }
}
