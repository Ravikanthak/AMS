ClassicEditor.builtinPlugins.push(function (editor) {
    editor.keystrokes.set('Tab', function (data, stop) {
        editor.model.change(writer => {
            const selection = editor.model.document.selection;
            const ranges = Array.from(selection.getRanges());

            for (const range of ranges) {
                if (range.isCollapsed) {
                    writer.insertText('\t', range);
                } else {
                    const startPath = range.start.path;
                    const endPath = range.end.path;

                    const startTable = editor.model.document.getRoot().findClosest(startPath, node => node.is('table'));
                    const endTable = editor.model.document.getRoot().findClosest(endPath, node => node.is('table'));

                    if (startTable === endTable) {
                        const tableRanges = editor.model.createRangeIn(startTable);
                        const rangesToTab = Array.from(tableRanges.getWalker());

                        for (const rangeToTab of rangesToTab) {
                            if (rangeToTab.item.is('td')) {
                                writer.insertText('\t', rangeToTab.item);
                            }
                        }
                    }
                }
            }
        });

        return true;
    });
});
