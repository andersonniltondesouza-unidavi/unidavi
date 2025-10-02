import 'package:flutter/material.dart';

void main() => runApp(const SpacedItemsList());

class SpacedItemsList extends StatelessWidget {
  const SpacedItemsList({super.key});

  @override
  Widget build(BuildContext context) {
    const items = 6;

    return MaterialApp(
      title: 'Flutter Demo',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        // Alteração da cor de fundo dos cards
        cardTheme: CardThemeData(color: Colors.yellowAccent),
      ),
      home: Scaffold(
        body: LayoutBuilder(
          builder: (context, constraints) {
            return SingleChildScrollView(
              child: ConstrainedBox(
                constraints: BoxConstraints(minHeight: constraints.maxHeight),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: List.generate(
                    items,
                    // Alteração para começar a contagem a partir de 1
                    (index) => ItemWidget(text:'Cartão ${index + 1}'),
                  ),
                ),
              ),
            );
          },
        ),
      ),
    );
  }
}

class ItemWidget extends StatelessWidget {
  const ItemWidget({super.key, required this.text});

  final String text;

  @override
  Widget build(BuildContext context) {
    return Card(
      // Adição de ícones dentro do card e alteração do estilo do texto
      child: SizedBox(height: 100, child: Row(mainAxisAlignment: MainAxisAlignment.center ,children: [Icon(Icons.access_alarms_outlined, color: Colors.lightGreen), Text(text, style:TextStyle(color: Colors.red),), Icon(Icons.star, color: Colors.lightGreen) ] )),
    );
  }
}