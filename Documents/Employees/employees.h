#ifndef EMPLOYEES_H
#define EMPLOYEES_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class Employees; }
QT_END_NAMESPACE

class Employees : public QMainWindow
{
    Q_OBJECT

public:
    Employees(QWidget *parent = nullptr);
    ~Employees();

private:
    Ui::Employees *ui;
};
#endif // EMPLOYEES_H
