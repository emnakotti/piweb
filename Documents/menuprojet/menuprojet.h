#ifndef MENUPROJET_H
#define MENUPROJET_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class menuprojet; }
QT_END_NAMESPACE

class menuprojet : public QMainWindow
{
    Q_OBJECT

public:
    menuprojet(QWidget *parent = nullptr);
    ~menuprojet();

private:
    Ui::menuprojet *ui;
};
#endif // MENUPROJET_H
