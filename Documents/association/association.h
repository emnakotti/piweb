#ifndef ASSOCIATION_H
#define ASSOCIATION_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class Association; }
QT_END_NAMESPACE

class Association : public QMainWindow
{
    Q_OBJECT

public:
    Association(QWidget *parent = nullptr);
    ~Association();

private:
    Ui::Association *ui;
};
#endif // ASSOCIATION_H
