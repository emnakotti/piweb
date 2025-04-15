#ifndef OEUVRES_H
#define OEUVRES_H

#include <QWidget>

namespace Ui {
class oeuvres;
}

class oeuvres : public QWidget
{
    Q_OBJECT

public:
    explicit oeuvres(QWidget *parent = nullptr);
    ~oeuvres();

private:
    Ui::oeuvres *ui;
};

#endif // OEUVRES_H
