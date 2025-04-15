#include "artistes.h"
#include "ui_artistes.h"

Artistes::Artistes(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::Artistes)
{
    ui->setupUi(this);
}

Artistes::~Artistes()
{
    delete ui;
}
