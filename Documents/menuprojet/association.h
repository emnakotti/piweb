#ifndef ASSOCIATION_H
#define ASSOCIATION_H

#include <QWidget>

namespace Ui {
class Association;
}

class Association : public QWidget
{
    Q_OBJECT

public:
    explicit Association(QWidget *parent = nullptr);
    ~Association();

private:
    Ui::Association *ui;
};

#endif // ASSOCIATION_H
