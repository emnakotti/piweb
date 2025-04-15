#include "prediction.h"

#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    prediction w;
    w.show();
    return a.exec();
}
