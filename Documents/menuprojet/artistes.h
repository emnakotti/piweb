#ifndef ARTISTES_H
#define ARTISTES_H

#include <QWidget>

namespace Ui {
class Artistes;
}

class Artistes : public QWidget
{
    Q_OBJECT

public:
    explicit Artistes(QWidget *parent = nullptr);
    ~Artistes();

private:
    Ui::Artistes *ui;
};

#endif // ARTISTES_H
