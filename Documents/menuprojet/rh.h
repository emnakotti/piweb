#ifndef RH_H
#define RH_H

#include <QWidget>

namespace Ui {
class RH;
}

class RH : public QWidget
{
    Q_OBJECT

public:
    explicit RH(QWidget *parent = nullptr);
    ~RH();

private:
    Ui::RH *ui;
};

#endif // RH_H
