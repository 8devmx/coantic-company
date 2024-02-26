const emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/
const login = new Vue({
  el: "#appLogin",
  data: {
    componentView: 1, //La vista del componente en la que actualmente te encuentras
    isLoading: false,
    isNotSame: false,
    loginFailed: false,
    loginSent: false,
    loginRecovery: false,
    loginDisabled: false,
    login: {
      usuario: "",
      password: "",
    },
    recovery: {
      newPassword: "",
      confirmPassword: "",
    },
    forgot: {
      forgotEmail: "",
    },
  },
  methods: {
    doLogin: function () {
      this.isLoading = true
      if (this.login.usuario != "" && this.login.password != "") {
        const data = new FormData()
        data.append("accion", "login")
        data.append("usuario", this.login.usuario)
        data.append("password", this.login.password)
        fetch($url + "includes/_funciones.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .catch((error) => console.error("Error:", error))
          .then((response) => {
            if (response.texto == true) {
              location.reload()
              window.location.href = $url + "dashboard"
            } else if (response.texto == "noexiste" || response.texto == "vacio") {
              this.loginFailed = true
            } else if (response.texto == "bloqueado") {
              this.loginDisabled = true
            }
            this.isLoading = false
          })
      } else {
        setTimeout(() => (this.isLoading = false), 500)
      }
    },
    doForgot: function () {
      this.isLoading = true
      if (this.forgot.forgotEmail != "") {
        const data = new FormData()
        data.append("accion", "forgot")
        data.append("email", this.forgot.forgotEmail)
        fetch($url + "includes/_funciones.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .catch((error) => console.error("Error:", error))
          .then((response) => {
            if (response.texto == true) {
              this.loginSent = true
              this.componentView = 1
              this.login.usuario = ""
              this.login.password = ""
              this.forgot.forgotEmail = ""
            } else {
              this.loginFailed = true
            }
          })
      }
      setTimeout(() => {
        this.isLoading = false
        this.loginSent = false
        this.loginFailed = false
      }, 500)
    },
    doRecovery: function () {
      if (!this.isNotSame) {
        const $hashInput = document.querySelector("#hash")
        let hash = $hashInput.value
        const data = new FormData()
        data.append("accion", "recovery")
        data.append("password", this.recovery.newPassword)
        data.append("hash", hash)
        fetch($url + "includes/_funciones.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .catch((error) => console.error("Error:", error))
          .then((response) => {
            if (response.texto == true) {
              this.loginRecovery = true
              this.componentView = 1
              this.login.usuario = ""
              this.login.password = ""
              this.forgot.forgotEmail = ""
            } else {
              this.loginFailed = true
            }
          })
      } else {
        alert("No son iguales")
      }
      setTimeout(() => {
        this.isLoading = false
        this.loginRecovery = false
        this.loginFailed = false
      }, 500)
    },
    validaIguales: function () {
      this.isNotSame = false
      if (this.recovery.newPassword !== this.recovery.confirmPassword) {
        this.isNotSame = true
      }
    },
  },
  computed: {},
  mounted: function () {},
})
