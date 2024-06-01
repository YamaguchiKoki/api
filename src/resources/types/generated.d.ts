declare namespace App.Data.Resources.User {
export type UserResource = {
id: string;
screenName: any | string;
bio: any | string;
imageUrl: any | string;
};
export type UserWithTokenResource = {
user: App.Data.Resources.User.UserResource;
token: string;
};
}
