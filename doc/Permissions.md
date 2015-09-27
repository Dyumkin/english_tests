Permissions
===========

## Roles

| Role name       | Description                 | Role identity `User::*` |
|:----------------|:---------------------------:|:------------------------|
| `guest`         | Anonymous user              | ROLE_GUEST              |
| `unconfirmed`   | Registered unconfirmed user | ROLE_UNCONFIRMED        |
| `user`          | Registered user             | ROLE_USER               |
| `client`        | Client user                 | ROLE_CLIENT             |
| `admin`         | Website administrator       | ROLE_ADMIN              |

## User permissions (incomplete)

| Permissions\Roles    | guest |   unconfirmed   |      user       |     client      |      admin      | Permission identity `User::*`    |
|:---------------------|:-----:|:---------------:|:---------------:|:---------------:|:---------------:|:---------------------------------|
| View profile         |   x   |        x        |        x        |        x        |        x        | PERMISSION_VIEW_PROFILE          |
| Edit profile         |       |      `own`      |      `own`      |      `own`      |        x        | PERMISSION_EDIT_PROFILE          |
| Delete profile       |       |      `own`      |      `own`      |      `own`      |        x        | PERMISSION_DELETE_USER           |


**Rules**
- `own` - _user is own_

## Domain permissions (incomplete)

| Permissions\Roles | Permanent rule |    guest    | unconfirmed |       user        |      client       | admin | Permission identity `Position::*` |
|:------------------|:--------------:|:-----------:|:-----------:|:-----------------:|:-----------------:|:-----:|:----------------------------------|
| View domain       |                |      x      |      x      |         x         |         x         |   x   | PERMISSION_VIEW                   |
| Create domain     |                |             |             |                   |         x         |   x   | PERMISSION_CREATE                 |
| Edit domain       |                |             |             |                   |       `own`       |   x   | PERMISSION_EDIT                   |
| Delete domain     |                |             |             |                   |       `own`       |   x   | PERMISSION_DELETE                 |


**Rules**
- `own` - _position is own_

## Level permissions (incomplete)

| Permissions\Roles | Permanent rule |    guest    | unconfirmed |       user        |      client       | admin | Permission identity `Position::*` |
|:------------------|:--------------:|:-----------:|:-----------:|:-----------------:|:-----------------:|:-----:|:----------------------------------|
| View level        |                |      x      |      x      |         x         |         x         |   x   | PERMISSION_VIEW                   |
| Create level      |                |             |             |                   |         x         |   x   | PERMISSION_CREATE                 |
| Edit level        |                |             |             |                   |       `own`       |   x   | PERMISSION_EDIT                   |
| Delete level      |                |             |             |                   |       `own`       |   x   | PERMISSION_DELETE                 |


**Rules**
- `own` - _position is own_

## Question permissions (incomplete)

| Permissions\Roles | Permanent rule |    guest    | unconfirmed |       user        |      client       | admin | Permission identity `Position::*` |
|:------------------|:--------------:|:-----------:|:-----------:|:-----------------:|:-----------------:|:-----:|:----------------------------------|
| View question     |                |      x      |      x      |         x         |         x         |   x   | PERMISSION_VIEW                   |
| Create question   |                |             |             |                   |         x         |   x   | PERMISSION_CREATE                 |
| Edit question     |                |             |             |                   |       `own`       |   x   | PERMISSION_EDIT                   |
| Delete question   |                |             |             |                   |       `own`       |   x   | PERMISSION_DELETE                 |


**Rules**
- `own` - _position is own_

