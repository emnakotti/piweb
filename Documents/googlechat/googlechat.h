#ifndef GOOGLECHAT_H
#define GOOGLECHAT_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class googlechat; }
QT_END_NAMESPACE

class googlechat : public QMainWindow
{
    Q_OBJECT

public:
    googlechat(QWidget *parent = nullptr);
    ~googlechat();

private:
    Ui::googlechat *ui;
};
#endif // GOOGLECHAT_H
