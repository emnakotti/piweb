#include "menuprojet.h"
#include "ui_menuprojet.h"

menuprojet::menuprojet(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::menuprojet)
{
    ui->setupUi(this);
}

menuprojet::~menuprojet()
{
    delete ui;
}

