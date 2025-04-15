#include "association.h"
#include "ui_association.h"

Association::Association(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::Association)
{
    ui->setupUi(this);
}

Association::~Association()
{
    delete ui;
}

