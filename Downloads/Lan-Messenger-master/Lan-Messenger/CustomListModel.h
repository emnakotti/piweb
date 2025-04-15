#ifndef CUSTOMLISTMODEL_H
#define CUSTOMLISTMODEL_H

#include <QAbstractListModel>

class customlistmodel : public QAbstractListModel
{
    Q_OBJECT

public:
    explicit customlistmodel(QObject *parent = nullptr);

    // Header:
    QVariant headerData(int section, Qt::Orientation orientation, int role = Qt::DisplayRole) const override;

    // Basic functionality:
    int rowCount(const QModelIndex &parent = QModelIndex()) const override;

    QVariant data(const QModelIndex &index, int role = Qt::DisplayRole) const override;

private:
};

#endif // CUSTOMLISTMODEL_H
