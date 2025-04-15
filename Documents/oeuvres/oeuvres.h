#ifndef OEUVRES_H
#define OEUVRES_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class Oeuvres; }
QT_END_NAMESPACE

class Oeuvres : public QMainWindow
{
    Q_OBJECT

public:
    Oeuvres(QWidget *parent = nullptr);
    ~Oeuvres();

private:
    Ui::Oeuvres *ui;
};
#endif // OEUVRES_H
