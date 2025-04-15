#ifndef EVENEMENT_H
#define EVENEMENT_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class Evenement; }
QT_END_NAMESPACE

class Evenement : public QMainWindow
{
    Q_OBJECT

public:
    Evenement(QWidget *parent = nullptr);
    ~Evenement();

private:
    Ui::Evenement *ui;
};
#endif // EVENEMENT_H
