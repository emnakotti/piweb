#ifndef PREDICTION_H
#define PREDICTION_H

#include <QMainWindow>

QT_BEGIN_NAMESPACE
namespace Ui { class prediction; }
QT_END_NAMESPACE

class prediction : public QMainWindow
{
    Q_OBJECT

public:
    prediction(QWidget *parent = nullptr);
    ~prediction();

private:
    Ui::prediction *ui;
};
#endif // PREDICTION_H
