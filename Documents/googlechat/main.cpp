#include "googlechat.h"

#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    googlechat w;
    w.show();
    return a.exec();
}
