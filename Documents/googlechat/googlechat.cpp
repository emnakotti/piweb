#include "googlechat.h"
#include "ui_googlechat.h"

googlechat::googlechat(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::googlechat)
{
    ui->setupUi(this);
}

googlechat::~googlechat()
{
    delete ui;
}

