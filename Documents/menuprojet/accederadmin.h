#ifndef ACCEDERADMIN_H
#define ACCEDERADMIN_H

#include <QDialog>

namespace Ui {
class accederadmin;
}

class accederadmin : public QDialog
{
    Q_OBJECT

public:
    explicit accederadmin(QWidget *parent = nullptr);
    ~accederadmin();

private:
    Ui::accederadmin *ui;
};

#endif // ACCEDERADMIN_H
