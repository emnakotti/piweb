#include "evenement.h"

#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    Evenement w;
    w.show();
    return a.exec();
}
