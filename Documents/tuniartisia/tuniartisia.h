#ifndef TUNIARTISIA_H
#define TUNIARTISIA_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class tuniartisia; }
QT_END_NAMESPACE

class tuniartisia : public QMainWindow
{
    Q_OBJECT

public:
    tuniartisia(QWidget *parent = nullptr);
    ~tuniartisia();

private:
    Ui::tuniartisia *ui;
};
#endif // TUNIARTISIA_H
