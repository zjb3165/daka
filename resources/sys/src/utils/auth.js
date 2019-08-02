import Cookies from 'js-cookie'

const TokenKey = 'sys_admin_token'
const TokenKeyExpires = 'sys_admin_token_expires'

export function getToken()
{
    return {
        token: Cookies.get(TokenKey),
        expires: parseInt(Cookies.get(TokenKeyExpires))
    }
}

export function setToken(token, expires)
{
    Cookies.set(TokenKey, token)
    Cookies.set(TokenKeyExpires, expires)
}

export function removeToken()
{
    Cookies.remove(TokenKeyExpires)
    Cookies.remove(TokenKey)
}